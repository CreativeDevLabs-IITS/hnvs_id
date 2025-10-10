<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StrandController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BgRemoveController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\GenerateidController;
use App\Models\User;
use App\Models\Teacher;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/setup', [TeacherController::class, 'setup']);
Route::post('/save/setup', [TeacherController::class, 'saveSetup']);



Route::get('list', [AttendanceController::class, 'list']);



Route::middleware(['auth:sanctum', 'preventBack'])->group(function() {
    Route::get('/trial', function () {
        return response()->json(['message' => 'API is working']);
    });
    Route::get('/current/user', [UserController::class, 'getuser']);
    Route::get('/user/list', [UserController::class, 'list']);
    Route::get('/search/user', [UserController::class, 'search']);
    Route::post('/create/user', [UserController::class, 'create']);
    Route::post('/find/user', [UserController::class, 'find']);
    Route::post('/edit/user', [UserController::class, 'edit']);
    Route::post('/delete/user', [UserController::class, 'delete']);
    Route::get('/count/user', [UserController::class, 'count']);
    Route::get('/select/user', function() {
        return User::select('id', 'firstname', 'lastname')->where('role', '!=', 0)->get();
    });

    Route::get('/current/user', [TeacherController::class, 'getuser']);
    Route::get('/teachers/list', [TeacherController::class, 'list']);
    Route::get('/search/teacher', [TeacherController::class, 'search']);
    Route::post('/create/teacher', [TeacherController::class, 'create']);
    Route::post('/find/teacher', [TeacherController::class, 'find']);
    Route::post('/edit/teacher', [TeacherController::class, 'edit']);
    Route::post('/delete/teacher', [TeacherController::class, 'delete']);
    Route::get('/count/teachers', [TeacherController::class, 'count']);
    Route::get('/select/teachers', function() {
        return Teacher::select('id', 'firstname', 'lastname')->where('role', '!=', 0)->get();
    });

    Route::get('/student/list', [StudentController::class, 'list']);
    Route::get('/student/unpaginated/list', [StudentController::class, 'unpaginatedList']);
    Route::post('/student/create', [StudentController::class, 'create']);
    Route::post('/find/student', [StudentController::class, 'findStudent']);
    Route::post('/edit/student', [StudentController::class, 'edit']);
    Route::get('/search/student', [StudentController::class, 'search']);
    Route::post('/delete/student', [StudentController::class, 'delete']);
    Route::post('/student/import', [StudentController::class, 'import']);
    Route::get('/count/students', [StudentController::class, 'count']);
    Route::get('/section/strand/list', [StudentController::class, 'sectionStrandList']);
    Route::post('/student/roster', [StudentController::class, 'subjectRoster']);

    Route::post('/create/strand', [StrandController::class, 'create']);
    Route::post('/update/strand', [StrandController::class, 'update']);
    Route::get('/list/strands', [StrandController::class, 'list']);
    Route::post('/delete/strand', [StrandController::class, 'delete']);
    Route::post('/find/strand', [StrandController::class, 'find']);

    Route::get('/subject/list', [SubjectController::class, 'list']);
    Route::post('/subject/create', [SubjectController::class, 'create']);
    Route::post('/find/subject', [SubjectController::class, 'find']);
    Route::post('/subject/edit', [SubjectController::class, 'edit']);
    Route::post('/subject/delete', [SubjectController::class, 'delete']);

    Route::get('/section/list', [StrandController::class, 'sectionList']);
    Route::post('/section/create', [StrandController::class, 'addSection']);
    Route::post('/section/edit', [StrandController::class, 'editSection']);
    Route::post('/section/delete', [StrandController::class, 'deleteSection']);
    Route::post('/subject/roster', [StudentController::class, 'subjectStudents']);
    Route::post('/subject/roster/import', [SubjectController::class, 'subjectRosterImport']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::post('api/remove-bg', [BgRemoveController::class, 'remove']);
    Route::get('/students', [StudentController::class, 'index']); 
    Route::post('/students/search', [StudentController::class, 'searchgenerateid']); 
    Route::get('/showstudentid/{id}', [StudentController::class, 'show']);
    Route::post('/save-generated-id', [GenerateidController::class, 'store']);
    Route::get('/showgeneratedids', [GenerateidController::class, 'index']);
    Route::delete('/deletegenerate/{id}', [GenerateidController::class, 'destroy']);
    Route::get('/fetchStudentInfo/{id}', [GenerateidController::class, 'fetchStudentInfo']);
    Route::post('/get-doorway', [GenerateidController::class, 'getStudentDoorway']);

});


// mobile
Route::middleware(['preventAccess'])->group(function() {
    Route::post('mobile/logout', [UserController::class, 'mobileLogout']);

    Route::post('subject/qr-attendance', [QRCodeController::class, 'validateQr']);
    
    Route::post('/mobile/subjects-list', [SubjectController::class, 'subjectListByDay']);
    Route::post('/today/subject-list', [SubjectController::class, 'subjectListToday']);
    Route::post('/current-class', [SubjectController::class, 'currentClass']);
    Route::post('/update/attendance', [SubjectController::class, 'editAttendace']);
});

Route::get('qr_code/verify/{token}', [QRCodeController::class, 'studentQRValidation']);
Route::post('find-student', [StudentController::class, 'searchSpecificStudent']);
Route::post('save/student-info', [StudentController::class, 'saveStudentInfo']);
