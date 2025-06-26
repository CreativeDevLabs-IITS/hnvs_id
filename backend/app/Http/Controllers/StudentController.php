<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Exception;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;

class StudentController extends Controller
{
    public function list() {
        return response()->json([
            'students' => Student::paginate(10)
        ]);
    }

    public function create(Request $request) {
        try {
            $validate = $request->validate([
                'firstname' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'middlename' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'suffix' => 'nullable',
                'contact' => 'required',
                'emergency_contact' => 'required',
                'birthdate' => 'required',
                'age' => 'required|numeric',
                'student_id' => 'required',
                'lrn' => 'required',
                'barangay' => 'required',
                'municipality' => 'required',
                'signature' => 'required|mimes:png,jpg,jpeg',
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);

            $validate['year_level'] = 11;

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('images', 'public');
                $validate['image'] = $path;
            }

            if($request->hasFile('signature')) {
                $signFile = $request->file('signature');
                $signPath = $signFile->store('images', 'public');
                $validate['signature'] = $signPath;
            }

            $student = Student::create($validate);

            $qrData = json_encode([
                'id' => $student['id'],
                'firstname' => $student['firstname'],
                'middlename' => $student['middlename'],
                'lastname' => $student['lastname'],
                'barangay' => $student['barangay'],
                'municipality' => $student['municipality'],
                'emergency_contact' => $student['emergency_contact'],
            ]);

            $qrcode = QrCode::create($qrData);
            $writer = new PngWriter();
            $result = $writer->write($qrcode);
            $fileName = 'qr_code/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $result->getString());
            $qr_path = 'http://hnvs_backend.test/' . $fileName;
            $student->qr_code = $qr_path;

            $student->save();
            return response()->json([
                'message' => 'Student added successfully.',
                'path' => Storage::url($fileName)
            ], 200);

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function findStudent(Request $request) {
        return response()->json([
            'student' => Student::find($request->id)
        ]);
    }

    public function edit(Request $request) {
        try {
            $student = Student::find($request->id);
            $validate = $request->validate([
                'firstname' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'middlename' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['nullable', 'string', 'regex:/^[A-Za-z\s]+$/'],
                'suffix' => 'nullable',
                'contact' => 'nullable',
                'emergency_contact' => 'nullable',
                'birthdate' => 'nullable',
                'age' => 'nullable|numeric',
                'student_id' => 'nullable',
                'lrn' => 'required',
                'barangay' => 'nullable',
                'municipality' => 'nullable',
                'signature' => 'nullable|mimes:png,jpg,jpeg',
                'image' => 'nullable|mimes:png,jpg,jpeg'
            ]);
            $validate['year_level'] = 11;

            if($request->hasFile('image')) {
                if($student->image && Storage::disk('public')->exists($student->image)) {
                    Storage::disk('public')->delete($student->image);
                }

                $file = $request->file('image');
                $path = $file->store('images', 'public');
                $validate['image'] = $path;
            }

            if($request->hasFile('signature')) {
                if($student->signature && Storage::disk('public')->exists($student->signature)) {
                    Storage::disk('public')->delete($student->signature);
                }

                $signFile = $request->file('signature');
                $signPath = $signFile->store('images', 'public');
                $validate['signature'] = $signPath;
            }

            $student->update($validate);
            return response()->json([
                'message' => 'Student edited successfully.'
            ], 200);

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->errors()
            ], 422);
        }
    }

    public function search(Request $request) {
        try {
            $students = Student::query();

            if($request->has('search')) {
                $search = $request->input('search');
                $students->where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('lrn', 'LIKE', "%{$search}%")
                ->orWhere('student_id', 'LIKE', "%{$search}%");
            }

            return response()->json([
                'students' => $students->paginate()
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function delete(Request $request) {
        try {
            $student = Student::find($request->id);
            if($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
            }

            if($student->signature && Storage::disk('public')->exists($student->signature)) {
                Storage::disk('public')->delete($student->signature);
            }

            if($student->qr_code && Storage::disk('public')->exists($student->qr_code)) {
                Storage::disk('public')->delete($student->qr_code);
            }

            $student->delete();

            return response()->json([
                'message' => 'Student deleted successfully'
            ]);

        }catch(Exception $e) {
            return response()->json([
                'error' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function import(Request $request) {
        try {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,csv'
            ]);
            $import = new StudentImport;
            Excel::import($import, $request->file('file'));

            foreach($import->rows as $row) {
                $student = Student::create([
                    'firstname' => $row['firstname'],
                    'middlename' => $row['middlename'],
                    'lastname' => $row['lastname'],
                    'suffix' => $row['suffix'] ?? null,
                    'barangay' => $row['barangay'],
                    'municipality' => $row['municipality'],
                    'age' => $row['age'],
                    'contact' => $row['contact'],
                    'lrn' => $row['lrn'],
                    'emergency_contact' => $row['emergency_contact'],
                    'birthdate' => $row['birthdate'],
                    'year_level' => $row['year_level'],
                    'student_id' => $row['student_id']
                ]);

                $qrData = json_encode([
                    'id' => $student['id'],
                    'firstname' => $student['firstname'],
                    'middlename' => $student['middlename'],
                    'lastname' => $student['lastname'],
                    'barangay' => $student['barangay'],
                    'municipality' => $student['municipality'],
                    'emergency_contact' => $student['emergency_contact'],
                ]);

                $qrcode = QrCode::create($qrData);
                $writer = new PngWriter();
                $result = $writer->write($qrcode);
                $fileName = 'qr_code/' . uniqid() . '.png';
                Storage::disk('public')->put($fileName, $result->getString());
                $path = 'http://hnvs_backend.test/' . $fileName;
                $student->qr_code = $path;
                $student->save();
            }

            return response()->json([
                'message' => 'Students imported successfully'
            ]);

        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

}
