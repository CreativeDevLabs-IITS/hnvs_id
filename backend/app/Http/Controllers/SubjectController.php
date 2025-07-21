<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RosterImport;
use App\Models\Subject;
use App\Models\Student;
use Exception;

class SubjectController extends Controller
{
    public function list() {
        return response()->json([
            'subjects' => Subject::with('teachers')->paginate(10)
        ], 200);
    }

    public function create(Request $request){
        try {
            $validate = $request->validate([
                'name' => 'required',
                'school_year' => 'required',
                'year_level' => 'required',
                'semester' => 'required',
                'description' => 'nullable',
                'teachers' => 'required',
                'section' => 'required',
                'time_start' => 'required',
                'time_end' => 'required'
            ]);

            $validate['day'] = implode(',' , $request->day);

            $exist = Subject::where('name', $validate['name'])
            ->where('section', $validate['section'])->exists();

            if($exist) {
                return response()->json([
                    'error' => 'Subject with the same section already exists.'
                ], 409);
            }

            $subject = Subject::create($validate);
            $subject->teachers()->sync($validate['teachers']);

            return response()->json([
                'message' => 'Subject added successfully'
            ]);

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function edit(Request $request){
        try {
            $subject = Subject::find($request->id);
            $validate = $request->validate([
                'name' => 'required',
                'school_year' => 'required',
                'year_level' => 'required',
                'semester' => 'required',
                'description' => 'nullable',
                'teachers' => 'required',
                'teachers.*' => 'exists:users,id',
            ]);

            $subject->update($validate);
            $subject->teachers()->sync($validate['teachers']);

            return response()->json([
                'message' => 'Subject added successfully'
            ]);

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function find(Request $request) {
        return response()->json([
            'subject' => Subject::find($request->id)->load('teachers')
        ]);
    }

    public function delete(Request $request) {
        try {
            $subject = Subject::find($request->id);
            $subject->delete();

            return response()->json([
                'message' => 'Subject deleted successfully.'
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function subjectRosterImport(Request $request) {
        try {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $import = new RosterImport();
        Excel::import($import, $request->file('file'));

            foreach($import->rows as $row) {
                $subject = Subject::where('name', $row['subject'])->first();
                $student = Student::where('lrn', $row['lrn'])->first();
                $skipped = [];

                    if($subject && $student) {
                        $subject->students()->syncWithoutDetaching($student->id);
                    }else {
                        $skipped[] = '(LRN:' . $row['lrn'] . ')';
                        continue;
                    }
            }

            return response()->json([
                'message' => 'Roster imported successfully.',
                'skipped' => isset($skipped) && count($skipped) > 0 ?
                             'Import successful. Skipped students with LRNs: ' . implode(', ', $skipped)
                             : ''
            ]);

        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
