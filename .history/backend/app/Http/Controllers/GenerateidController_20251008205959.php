<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\GenerateId;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class GenerateidController extends Controller
{
    public function index()
    {
        $students = GenerateId::join('students', 'generate_ids.student_id', '=', 'students.id')
            ->leftJoin('strands', 'students.strand_id', '=', 'strands.id') 
            ->select(
                'students.id',
                'students.firstname',
                'students.middlename',
                'students.lastname',
                'students.age',
                'students.barangay',
                'students.lrn',
                'students.qr_path',
                'students.municipality',
                'students.emergency_contact',
                'students.image',
                'students.signature',
                'generate_ids.print_count'
                )
            ->get();
        return response()->json($students);
    }
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'photo_position' => 'nullable|string',     
            'signature_position' => 'nullable|string',
            'school_year' => 'nullable|string|max:20', 
        ]);
        $generated = GenerateId::where('student_id', $request->student_id)->first();
        if ($generated) {
            $generated->increment('print_count');
        } else {
            $generated = GenerateId::create([
                'student_id' => $request->student_id,
                'print_count' => 1,
            ]);
        }
        $student = Student::findOrFail($request->student_id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $student->image = env('APP_URL') . '/images/' . $filename;
        }
        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $student->signature = env('APP_URL') . '/images/' . $filename;
        }
          // --- Save positions ---
        if ($request->has('photo_position')) {
            $student->photo_position = $request->photo_position; 
        }
        if ($request->has('signature_position')) {
            $student->signature_position = $request->signature_position; 
        }
        if ($request->has('school_year')) {
            $student->school_year = $request->school_year;
        }
        $student->save();
        return response()->json([
            'message' => 'Generated ID saved successfully',
            'data' => $generated
        ]);
    }
    public function destroy($id)
    {
        $generated = GenerateId::where('student_id', $id)->first();
        if (!$generated) {
            return response()->json([
                'message' => 'Generated ID not found'
            ], 404);
        }
        $generated->delete();

        return response()->json([
            'message' => 'Generated ID deleted successfully'
        ]);
    }
    public function fetchStrandDoorway($studentId)
    {
        $student = \DB::table('students')
            ->leftJoin('strands', 'students.strand_id', '=', 'strands.id')
            ->where('students.id', $studentId)
            ->select(
                'students.id',
                'strands.cluster as strand_name',
                'students.doorway'
            )
            ->first();

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json([
            'id' => $student->id,
            'strand_name' => $student->strand_name,
            'doorway' => $student->doorway
        ]);
    }


    public function fetchStudentInfo($studentId) {
        try {
            $student = Student::with('strand')->find($studentId);
    
            if(!$student) {
                return response()->json([
                    'error' => 'Student not found'
                ], 404);
            }

            return response()->json([
                'student' => $student
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
