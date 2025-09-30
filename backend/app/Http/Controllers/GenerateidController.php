<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Generateid;
use Illuminate\Http\Request;

class GenerateidController extends Controller
{
    public function index()
    {
        $students = Generateid::join('students', 'generate_ids.student_id', '=', 'students.id')
            ->select(
                'students.id',
                'students.firstname',
                'students.middlename',
                'students.lastname',
                'students.age',
                'students.barangay',
                'students.lrn',
                'students.municipality',
                'students.emergency_contact',
                'generate_ids.print_count'
            )
            ->get();

        return response()->json($students);
    }
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);
        $generated = Generateid::where('student_id', $request->student_id)->first();
        if ($generated) {
            $generated->increment('print_count');
        } else {
            $generated = Generateid::create([
                'student_id' => $request->student_id,
                'print_count' => 1,
            ]);
        }
        return response()->json([
            'message' => 'Generated ID saved successfully',
            'data' => $generated
        ]);
    }


    public function destroy($id)
    {
        $generated = Generateid::where('student_id', $id)->first();
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
}
