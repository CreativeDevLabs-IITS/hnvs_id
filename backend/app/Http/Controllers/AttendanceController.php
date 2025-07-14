<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function list() {
        return response()->json([
            'list' => Attendance::all()
        ]);
    }
}
