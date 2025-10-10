<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;

class QRCodeController extends Controller
{
    public function validateQr(Request $request) {
        try {
            $today = Carbon::today();
            $currentTime = Carbon::now();
            $subject = Subject::find($request->subject_id);
            $timeStart = Carbon::createFromFormat('H:i:s', $subject->time_start, 'Asia/Manila');
            $gracePeriod = $today->copy()->setTimeFrom($timeStart)
                            ->addMinutes($subject->grace_period);

            $validateStudent = Student::with(['section', 'subjects', 'strand', 'attendances'])
            ->where('qr_token', $request->qr_token)
            ->whereHas('subjects', function($subject) use ($request) {
                $subject->where('subjects.id', $request->subject_id);
            })->first();

            if(!$validateStudent) {
                return response()->json([
                    'error' => 'Student is not part of this subject.',
                ], 400);
            }

            $status = '';
            $minutes_late = null;

            if($gracePeriod->gte($currentTime)) {
                $status = 'present';
            }else {
                $status = 'late';
                $minutes_late = $gracePeriod->diffInMinutes($currentTime);
            }

            $scanned = $validateStudent->attendances()
            ->wherePivot('subject_id', $request->subject_id)
            ->whereDate('subject_attendance.created_at', $today)
            ->exists();

            if($scanned) {
                return response()->json([
                    'error' => 'Student already scanned.'
                ], 400);
            }

            $validateStudent->attendances()->syncWithoutDetaching([
                $request->subject_id => [
                    'status' => $status,
                    'minutes_late' => $minutes_late
                ]
            ]);
            return response()->json([
                'student' => $validateStudent,
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }


    public function studentQRValidation($token) {
        try {
            $student = Student::with('strand')
            ->where('qr_token', $token)->first();

            if(!$student) {
                return response()->json([
                    'error' => 'Student does not exist in the record.'
                ], 404);
            }

            return response()->json([
                'data' => $student
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getStudentDoorway(Request $reqest) {
        try {
            $doorway = Strand->where(cluster, $request->doorway)->first();
            if(!$doorway) {
                return response()->json([
                    'error' => "Doorway not found."
                ], 404);
            }
            
            return response()-json([
                'doorway' => $doorway
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
