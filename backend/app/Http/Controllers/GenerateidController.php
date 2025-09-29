<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Generateid;
use Illuminate\Http\Request;

class GenerateidController extends Controller
{
    public function index()
    {
        $students = Student::select(
                'students.id',
                'students.firstname',
                'students.middlename',
                'students.lastname',
                'students.gender',
                'students.barangay',
                'students.municipality',
                'students.emergency_contact'
            )
            ->withCount([
                'generatedIds as print_count' => function ($query) {
                    $query->select(\DB::raw("COALESCE(SUM(print_count),0)"));
                }
            ])
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
}
