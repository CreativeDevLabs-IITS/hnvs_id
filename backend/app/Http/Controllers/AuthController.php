<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Teacher;

class AuthController extends Controller
{
    public function login(Request $request) {
        try {
            if(is_null($request->email) || is_null($request->password)) {
                return response()->json([
                    'error' => 'Email and password are required.'
                ], 422);
            }

            $credentials = User::where('email', $request->email)->first() ??
                    Teacher::where('email', $request->email)->first();

            if($credentials && Hash::check($request->password, $credentials->password)) {
                $token = $credentials->createToken('personal-token')->plainTextToken;

                return response()->json([
                    'token' => $token,
                    'role' => $credentials->role,
                    'id' => $credentials->id
                ], 200);
            }else {
                return response()->json([
                    'error' => 'Invalid credentials'
                ], 401);
            }

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }
}
