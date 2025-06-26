<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/current/user', [UserController::class, 'getuser']);
    Route::get('/teachers/list', [UserController::class, 'list']);
    Route::get('/search/teacher', [UserController::class, 'search']);
    Route::post('/create/teacher', [UserController::class, 'create']);
    Route::post('/find/teacher', [UserController::class, 'find']);
    Route::post('/edit/teacher', [UserController::class, 'edit']);
    Route::post('/delete/teacher', [UserController::class, 'delete']);

    Route::get('/student/list', [StudentController::class, 'list']);
    Route::post('/student/create', [StudentController::class, 'create']);
    Route::post('/find/student', [StudentController::class, 'findStudent']);
    Route::post('/edit/student', [StudentController::class, 'edit']);
    Route::get('/search/student', [StudentController::class, 'search']);
    Route::post('/delete/student', [StudentController::class, 'delete']);
    Route::post('/student/import', [StudentController::class, 'import']);
});

