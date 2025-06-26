<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Models\User;

class UserController extends Controller
{
    public function getUser() {
        return response()->json(Auth::user());
    }

    public function list() {
        return response()->json([
            // 'teachers' => User::where('role', '!=', '0')->get()
            'teachers' => User::all()
        ]);
    }

    public function search(Request $request) {
        try {
            $teacher = User::query();

            if($request->has('search')) {
                $search = $request->input('search');
                $teacher->where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%");
            }

            return response()->json([
                'teachers' => $teacher->get()
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
            ]);
            $validate['role'] = 1;

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('images', 'public');
                $validate['image'] = $path;
            }

            $user = User::create($validate);
            return response()->json([
                'message' => 'Teacher added successfully.'
            ], 200);

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }

    }

    public function find(Request $request) {
        return response()->json([
            'teacher' => User::find($request->id)
        ]);
    }

    public function edit(Request $request) {
        try {
            $teacher = User::find($request->id);

            $validate = $request->validate([
                'firstname' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'middlename' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'suffix' => 'nullable',
                'contact' => 'nullable',
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users')->ignore($teacher->id)
                ]
            ]);

            if($request->hasFile('image')) {
                if($teacher->image && Storage::disk('public')->exists($teacher->image)) {
                    Storage::disk('public')->delete($teacher->image);
                }

                $file = $request->file('image');
                $path = $file->store('images', 'public');
                $validate['image'] = $path;
            }
            $teacher->update($validate);

            return response()->json([
                'message' => 'Teacher updated successfully'
            ]);
        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request) {
        try {
            $teacher = User::find($request->id);
            if($teacher->image && Storage::disk('public')->exists($teacher->image)) {
                Storage::disk('public')->delete($teacher->image);
            }

            $teacher->delete();

            return response()->json([
                'message' => 'Teacher deleted'
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => 'Something went wrong. Please try again later.'
            ]);
        }
    }
}
