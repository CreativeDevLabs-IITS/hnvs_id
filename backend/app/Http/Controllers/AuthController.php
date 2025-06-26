<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        try {
            if(is_null($request->email) || is_null($request->password)) {
                return response()->json([
                    'error' => 'Email and password are required.'
                ]);
            }

            $credentials = User::where('email', $request->email)->first();
            if($credentials && Hash::check($request->password, $credentials->password)) {
                $token = $credentials->createToken('personal-token')->plainTextToken;

                return response()->json([
                    'token' => $token,
                ], 200);
            }else {
                return response()->json([
                    'error' => 'Invalid credentials'
                ]);
            }

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
