<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherCredential;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Teeacher;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function getUser() {
        return response()->json(Auth::user());
    }

    public function list() {
        return response()->json([
            'users' => User::where('role', '!=', '0')->get()
        ]);
    }

    public function search(Request $request) {
        try {
            $user = User::query();

            if($request->has('search')) {
                $search = $request->input('search');
                $user->where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%");
            }

            return response()->json([
                'users' => $user->get()
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => 'Something went wrong. Please try again later.'
            ]);
        }
    }

    public function create(Request $request) {
        try {
            $validate = $request->validate([
                'firstname' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'middlename' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'suffix' => 'nullable',
                'contact' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role' => 'required'
            ]);

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('images', 'public');
                $validate['image'] = $path;
            }

            $user = User::create($validate);

            $user->email_token = Str::random(60);
            $user->email_token_expires_at = now()->addHours(48);
            $user->save();
            $link = 'http://hnvs.system.test/setup.php?token=' . $user->email_token;

            try {
                Mail::to($user->email)->send(new TeacherCredential($user->firstname, $link));
            }catch(Exception $e) {
                return response()->json([
                    'error' => 'Failed to send email. Please check the email address or try again later.'
                ]);
            }


            return response()->json([
                'message' => 'User added successfully.'
            ], 200);

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }

    }

    public function find(Request $request) {
        return response()->json([
            'user' => User::find($request->id)
        ]);
    }

    public function edit(Request $request) {
        try {
            $user = User::find($request->id);

            $validate = $request->validate([
                'firstname' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'middlename' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'suffix' => 'nullable',
                'contact' => 'nullable',
                'role' => 'nullable',
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users')->ignore($user->id)
                ]
            ]);

            if($request->hasFile('image')) {
                if($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }

                $file = $request->file('image');
                $path = $file->store('images', 'public');
                $validate['image'] = $path;
            }
            $user->update($validate);

            return response()->json([
                'message' => 'User updated successfully'
            ]);
        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request) {
        try {
            $user = User::find($request->id);
            if($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $user->delete();

            return response()->json([
                'message' => 'User deleted'
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => 'Something went wrong. Please try again later.'
            ]);
        }
    }

    // public function count() {
    //     return response()->json([
    //         'teachers' => User::count(),
    //         'user' => Auth::user()
    //     ]);
    // }

    public function logout(Request $request) {
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function setup(Request $request) {
        try {
            $token = $request->token;
            $user = User::where('email_token', $token)->first();

            if(!$user) {
                return response()->json([
                    'invalid' => 'We are sorry, the page requested was invalid. Please try again.'
                ], 404);
            }

            if(now()->greaterThan($user->email_token_expires_at)) {
                return response()->json([
                    'expired' => 'We are sorry, but the requested page token has expired.<br> Please ask your administrator for your credentials.'
                ]);
            }

            return response()->json([
                'data' => $user
            ]);

        }catch(Exception $e) {
            return response()->json([
                'error' => 'Somthing went wrong. Please try again later.'
            ]);
        }
    }

    public function saveSetup(Request $request) {
        try {
            $user = User::find($request->id);
            $validate = $request->validate([
                'password' => 'required'
            ]);

            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'message' => 'Password setup saved.'
            ]);
        }catch (ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }



    // mobile
    public function mobileLogout(Request $request) {
        try {
            $token = PersonalAccessToken::where('token', hash('sha256', $request->token))->first();

            if($token) {
                $token->delete();
            }

            return response()->json([
                'message' => 'Logged out successfully.'
            ], 200);

        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }
}
