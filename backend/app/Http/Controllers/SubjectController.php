<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RosterImport;
use Illuminate\Validation\Rule;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
            $validate['grace_period'] = 10;

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
                'name' => 'nullable', Rule::unique('subjects')->ignore($subject->id),
                'school_year' => 'nullable',
                'year_level' => 'nullable',
                'semester' => 'nullable',
                'description' => 'nullable',
                'teachers' => 'nullable',
                'section' => 'nullable',
                'time_start' => 'nullable',
                'time_end' => 'nullable'
            ]);
            $validate['day'] = implode(',' , $request->day);

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


    // mobile
    public function subjectListByDay(Request $request) {
        try {
            $daySelected = strtoupper($request->day);
            $subjects = Subject::with('teachers')
            ->whereHas('teachers', function($query) use ($request) {
                $query->where('teachers.id', $request->id);
            })
            ->whereRaw("FIND_IN_SET(?, day)", [$daySelected])->get();

            return response()->json([
                'subjects' => $subjects,
                'day' => $daySelected
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function subjectListToday(Request $request) {
        try{
            $today = Carbon::today()->format('D');

            $subjects = Subject::with('teachers')
            ->whereHas('teachers', function($subject) use ($request, $today) {
                $subject->where('teachers.id', $request->id);
            })
            ->whereRaw("FIND_IN_SET(?, day)", [strtoupper($today)])->get();

            return response()->json([
                'subjects' => $subjects
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function currentClass(Request $request) {
        try {
            $today = strtoupper(Carbon::today()->format('D'));
            $currentTime = Carbon::now()->format('H:i:s');

            $subject = Subject::with(['teachers', 'students', 'attendance'])
            ->whereHas('teachers', function($teacher) use ($request) {
                $teacher->where('teachers.id', $request->teacher_id);
            })
            ->whereRaw("FIND_IN_SET(?, day)", [$today])
            ->where('time_start', '<=', $currentTime)
            ->where('time_end', '>=', $currentTime)
            ->first();

            if(!$subject) {
                return response()->json([
                    'error' => "There is no ongoing class."
                ], 422);
            }

            return response()->json([
                'subject' => $subject,
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function editAttendace(Request $request) {
        try {
            $subject = Subject::find($request->subject_id);
            $timeStart = Carbon::createFromFormat('H:i:s', $subject->time_start, 'Asia/Manila');
            $gracePeriod = now()->copy()->setTimeFrom($timeStart)
                            ->addMinutes($subject->grace_period);

            $minutesLate = '';
            if($request->status == 'late') {
                $minutesLate = $gracePeriod->diffInMinutes(now());
            }

            $attendanceExist = $subject->attendance()
                ->wherePivot('student_id', $request->student_id)
                ->wherePivot('created_at', $request->created_at)
                ->first();

            if($attendanceExist) {
                DB::table('subject_attendance')
                    ->where('student_id', $request->student_id)
                    ->where('subject_id', $request->subject_id)
                    ->where('created_at', $request->created_at)
                    ->update([
                        'status' => $request->status,
                        'minutes_late' => $minutesLate,
                    ]);
            }

            if(!$attendanceExist) {
                DB::table('subject_attendance')->insert([
                    'student_id' => $request->student_id,
                    'subject_id' => $request->subject_id,
                    'status' => $request->status,
                    'created_at' => $request->created_at,
                    'minutes_late' => $minutesLate,
                    'updated_at' => now(),
                ]);
            }

            return response()->json([
                'message' => 'Attendance updated successfully.',
                'subject' => $attendanceExist
            ], 200);

        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

}
