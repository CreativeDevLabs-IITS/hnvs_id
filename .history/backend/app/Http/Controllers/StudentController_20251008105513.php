<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Student;
use App\Models\Section;
use App\Models\Strand;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function list() {
        return response()->json([
            'students' => Student::with(['section', 'strand', 'subjects'])->paginate(50)
        ]);
    }

    public function subjectRoster(Request $request) {
        $students = Student::with(['section', 'strand', 'subjects'])
        ->whereHas('subjects', function ($query) use ($request) {
            $query->where('subjects.id', $request->id);
        })->paginate(10);

        return response()->json([
            'students' => $students
        ]);
    }

    public function unpaginatedList() {
                return response()->json([
            'students' => Student::with('subjects')->get()
        ]);
    }

    public function create(Request $request) {
        try {
            $validate = $request->validate([
                'firstname' => 'required', 'string',
                'middlename' => 'nullable', 'string',
                'lastname' => 'required', 'string',
                'suffix' => 'nullable',
                'contact' => 'required',
                'emergency_contact' => 'required',
                'birthdate' => 'required',
                'age' => 'required|numeric',
                'lrn' => 'required',
                'barangay' => 'required',
                'municipality' => 'required',
                'signature' => 'nullable|mimes:png,jpg,jpeg',
                'section_id' => 'required',
                'year_level' => 'required|numeric',
                'doorway' => 'nullable',
            ]);

            $strand = Strand::find($request->strand);

            if(!$strand) {
                return response()->json([
                    'error' => 'Strand is required.'
                ]);
            }

            $tracks = [
                'Industrial Arts (IA)',
                'Family and Consumer Science (FCS)'
            ];

            if(in_array($strand->cluster, $tracks)) {
                if(empty($request->specialization)) {
                    return response()->json([
                        'error' => 'Specialization is required.'
                    ]);
                }else {
                    $validate['strand_id'] = $request->specialization;
                }
            }else {
                $validate['strand_id'] = $strand->id;
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $validate['image'] = env('APP_URL') . '/images/' . $filename;
            }

            if($request->hasFile('signature')) {
                $signFile = $request->file('signature');
                $signPath = $signFile->store('images', 'public');
                $validate['signature'] = env('APP_URL') . $signPath;
            }
            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $validate['signature'] = env('APP_URL') . '/images/' . $filename;
            }

            $student = Student::create($validate);

            $hashedQr = sha1(uniqid((string)$student->id, true));
            $qrData = env('FRONTEND_URL') . 'student/verify/' . $hashedQr;
            $qrcode = QrCode::create($qrData)
                ->setSize(400)
                ->setMargin(10);

            $logo = Logo::create(public_path('gallery/hnvslogoqr.png'))
                ->setResizeToWidth(70)
                ->setPunchoutBackground(true);

            $writer = new PngWriter();
            $result = $writer->write($qrcode, $logo);

            Storage::disk('public')->makeDirectory('qr_code');
            $fileName = 'qr_code/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $result->getString());

            $qr_path = env('APP_URL') . $fileName;
            $student->qr_path = $qr_path;
            $student->qr_token = $hashedQr;
            $student->qr_code = $qrData;
            $student->save();

            return response()->json([
                'message' => 'Student added successfully.',
                'path' => Storage::url($fileName)
            ], 200);

        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 422);
        }
    }

    public function findStudent(Request $request) {
        return response()->json([
            'student' => Student::find($request->id)->load(['section', 'strand'])
        ]);
    }

    public function edit(Request $request) {
        try {
            $student = Student::find($request->id);
            $validate = $request->validate([
                'firstname' => 'nullable', 'string',
                'middlename' => 'nullable', 'string',
                'lastname' => 'nullable', 'string',
                'suffix' => 'nullable',
                'contact' => 'nullable',
                'emergency_contact' => 'nullable',
                'birthdate' => 'nullable',
                'age' => 'nullable|numeric',
                'lrn' => 'required',
                'barangay' => 'nullable',
                'municipality' => 'nullable',
                'signature' => 'nullable|mimes:png,jpg,jpeg',
                'image' => 'nullable|mimes:png,jpg,jpeg',
                'section_id' => 'nullable',
                'year_level' => 'nullable|numeric',
                'doorway' => 'nullable'
            ]);

            if(!empty($request->strand)) {
                $strand = Strand::find($request->strand);

                $tracks = [
                    'Industrial Arts (IA)',
                    'Family and Consumer Science (FCS)'
                ];

                if(in_array($strand->cluster, $tracks)) {
                    $validate['strand_id'] = $request->specialization;
                }else {
                    $validate['strand_id'] = $strand->id;
                }
            }

            if($request->hasFile('image')) {
                if($student->image && Storage::disk('public')->exists($student->image)) {
                    Storage::disk('public')->delete($student->image);
                }

                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $validate['image'] = env('APP_URL') . '/images/' . $filename;
            }

            if($request->hasFile('signature')) {
                if($student->signature && Storage::disk('public')->exists($student->signature)) {
                    Storage::disk('public')->delete($student->signature);
                }


                $file = $request->file('signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $validate['signature'] = env('APP_URL') . '/images/' . $filename;
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
            $students = Student::query()->with(['section', 'strand', 'subjects']);

            if($request->filled('search')) {
                $search = $request->input('search');
                $students->where(function ($query) use ($search) {
                    $query->where('firstname', 'LIKE', "%$search%")
                            ->orWhere('lastname', 'LIKE', "%$search%")
                            ->orWhere('lrn', 'LIKE', "%$search%");
                });
            }

            if($request->filled('section')) {
                $section = $request->input('section');
                $students->whereHas('section', function ($query) use ($section) {
                    $query->where('name', $section);
                });
            }

            if($request->filled('doorway')) {
                $doorway = $request->input('doorway');
                $students->where('doorway', $doorway);
            }

            if($request->filled('strand')) {
                $strand = $request->input('strand');
                $students->whereHas('strand', function ($query) use ($strand) {
                    $query->where('cluster', $strand);
                });
            }

            return response()->json([
                'students' => $students->paginate(50)
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function searchSpecificStudent(Request $request) {
        try {
            if($request->filled('lrn')) {
                $student = Student::with(['section', 'strand', 'subjects'])
                ->where('lrn', $request->lrn)->first();
            }elseif($request->filled('firstname') && $request->filled('lastname')) {
                $query = Student::query()->with(['section', 'strand', 'subjects']);

                if($request->filled('firstname')) {
                    $query->where('firstname', 'LIKE', "%$request->firstname%");
                }

                if($request->filled('lastname')) {
                    $query->where('lastname', 'LIKE', "%$request->lastname%");
                }

                $student = $query->first();
            }else {
                return response()->json([
                    'error' => 'No search input provided'
                ], 400);
            }

            if(!$student) {
                return response()->json([
                    'error' => 'Student not found.'
                ], 404);
            }

            return response()->json([
                'data' => $student,
                'strands' => Strand::all()
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
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

    public function saveStudentInfo(Request $request) {
        try {
            $student = Student::find($request->studentID);

            if(!$student) {
                return response()->json([
                    'error' => 'Failed to save. Student not found.'
                ], 404);
            }

            $validate = $request->validate([
                'barangay' => 'required',
                'municipality' => 'required',
                'emergency_contact' => 'required',
                'contact' => 'required',
                'doorway' => 'nullable',
                'strand_id' => 'required'
            ]);

            $student->update($validate);

            return response()->json([
                'message' => 'Saved Successfully!'
            ], 200);
        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
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
            foreach ($import->rows as $row) {
                if(!empty($row['cluster'])) {
                    $strand = Strand::where('cluster', $row['cluster'])->first();

                    if (!$strand) {
                        $strand = Strand::create([
                            'cluster' => $row['cluster'],
                            'track' => $row['track'],
                            'specialization' => $row['specialization'] ?? null
                        ]);
                    }
                }

                $section = Section::where('name', $row['section'])->first();

                if (empty($row['first_name'])) {
                    \Log::warning('Skipping row with missing firstname', $row->toArray());
                    continue;
                }

                $namePart = explode(',', $row['emergency_contact']);
                $namePart = array_map('trim', $namePart);
                $first = $namePart[1] ?? '';
                $middle = $namePart[2] ?? '';
                $last = $namePart[0] ?? '';
                $middleInitial = $middle ? substr($middle, 0, 1) . '.' : '';
                $formattedName = $first . ' ' . $middleInitial . ' ' . $last;

                $student = Student::create([
                    'firstname' => $row['first_name'],
                    'middlename' => $row['middle_name'],
                    'lastname' => $row['last_name'],
                    'suffix' => $row['suffix'] ?? null,
                    'barangay' => $row['barangay'],
                    'municipality' => $row['town'],
                    'emergency_contact' => $formattedName,
                    'lrn' => $row['lrn'],
                    'birthdate' => is_numeric($row['birthday'])
                        ? Carbon::instance(ExcelDate::excelToDateTimeObject($row['birthday']))->format('Y-m-d')
                        : Carbon::parse($row['birthday'])->format('Y-m-d'),
                    'year_level' => '11',
                    'section_id' => $section->id ?? null,
                    'strand_id' => $strand->id ?? null,
                ]);
               $hashedQr = sha1(uniqid((string)$student->id, true));
                    $qrData = env('FRONTEND_URL') . 'student/verify/' . $hashedQr;

                    $qrcode = QrCode::create($qrData)
                        ->setSize(300)
                        ->setMargin(10);

                    $logo = Logo::create(public_path('gallery/hnvslogoqr.png'))
                        ->setResizeToWidth(60)
                        ->setPunchoutBackground(true);

                    $writer = new PngWriter();
                    // Removed $logo so QR will be plain
                    $result = $writer->write($qrcode); // , $logo);

                    $fileName = 'qr_code/' . uniqid() . '.png';
                    Storage::disk('public')->put($fileName, $result->getString());

                    $qr_path = env('APP_URL') . $fileName;

                    $student->qr_path = $qr_path;
                    $student->qr_token = $hashedQr;
                    $student->qr_code = $qrData;
                    $student->save();

            }
            return response()->json([
                'message' => 'Students imported successfully',
                'skipped' => isset($skipped) && count($skipped) > 0
                            ? 'Some information are missing for student/s: ' . implode(', ', $skipped)
                            : ''
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

// public function import(Request $request) {
//     try {
//         $request->validate([
//             'file' => 'required|file|mimes:xlsx,csv'
//         ]);

//         $import = new StudentImport;
//         Excel::import($import, $request->file('file'));

//         foreach ($import->rows as $row) {
//             // 🧠 Strand
//             if(!empty($row['cluster'])) {
//                 $strand = Strand::where('cluster', $row['cluster'])->first();

//                 if (!$strand) {
//                     $strand = Strand::create([
//                         'cluster' => $row['cluster'],
//                         'track' => $row['track'],
//                         'specialization' => $row['specialization'] ?? null
//                     ]);
//                 }
//             }

//             // 📌 Section
//             $section = Section::where('name', $row['section'])->first();

//             if (empty($row['first_name'])) {
//                 \Log::warning('Skipping row with missing firstname', $row->toArray());
//                 continue;
//             }

//             // 📞 Format emergency contact
//             $namePart = explode(',', $row['emergency_contact']);
//             $namePart = array_map('trim', $namePart);
//             $first = $namePart[1] ?? '';
//             $middle = $namePart[2] ?? '';
//             $last = $namePart[0] ?? '';
//             $middleInitial = $middle ? substr($middle, 0, 1) . '.' : '';
//             $formattedName = $first . ' ' . $middleInitial . ' ' . $last;

//             // 🧍 Create Student
//             $student = Student::create([
//                 'firstname' => $row['first_name'],
//                 'middlename' => $row['middle_name'],
//                 'lastname' => $row['last_name'],
//                 'suffix' => $row['suffix'] ?? null,
//                 'barangay' => $row['barangay'],
//                 'municipality' => $row['town'],
//                 'emergency_contact' => $formattedName,
//                 'lrn' => $row['lrn'],
//                 'birthdate' => is_numeric($row['birthday'])
//                     ? Carbon::instance(ExcelDate::excelToDateTimeObject($row['birthday']))->format('Y-m-d')
//                     : Carbon::parse($row['birthday'])->format('Y-m-d'),
//                 'year_level' => '11',
//                 'section_id' => $section->id ?? null,
//                 'strand_id' => $strand->id ?? null,
//             ]);

//             // 🌀 Generate QR with logo
//             $hashedQr = sha1(uniqid((string)$student->id, true));
//             $qrData = env('FRONTEND_URL') . 'student/verify/' . $hashedQr;

//             $qrcode = QrCode::create($qrData)
//                 ->setSize(300)
//                 ->setMargin(10);

//             // ✅ UNCOMMENTED & ACTIVE
//             $logo = Logo::create(public_path('storage/gallery/hnvslogoqr.png'))
//                 ->setResizeToWidth(60)
//                 ->setPunchoutBackground(true);

//             $writer = new PngWriter();
//             $result = $writer->write($qrcode, $logo);

//             $fileName = 'qr_code/' . $hashedQr . '.png';
//             Storage::disk('public')->put($fileName, $result->getString());

//             $qr_path = env('APP_URL') . 'storage/' . $fileName;

//             $student->qr_path = $qr_path;
//             $student->qr_token = $hashedQr;
//             $student->qr_code = $qrData;
//             $student->save();
//         }

//         return response()->json([
//             'message' => 'Students imported successfully',
//             'skipped' => isset($skipped) && count($skipped) > 0
//                         ? 'Some information are missing for student/s: ' . implode(', ', $skipped)
//                         : ''
//         ]);
//     } catch(Exception $e) {
//         return response()->json([
//             'error' => $e->getMessage()
//         ]);
//     }
// }

    public function count() {
        return response()->json([
            'students' => Student::count(),
        ]);
    }
    public function sectionStrandList() {
        return response()->json([
            'sections' => Section::all(),
            'strands' => Strand::all()
        ]);
    }
    public function subjectStudents(Request $request) {
        try {
            $student_ids = $request->ids;
            $subject_id = Subject::find($request->subject);

            $subject_id->students()->sync($student_ids);
            return response()->json([
                'message' => 'Subject roster updated successfully.'
            ]);

        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function index()
    {
        $students = Student::with('section')->get();
        return response()->json($students);
    }
    public function searchgenerateid(Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            return response()->json([]);
        }
        $students = Student::where('firstname', 'LIKE', "%{$query}%")
            ->orWhere('middlename', 'LIKE', "%{$query}%")
            ->orWhere('lastname', 'LIKE', "%{$query}%")
            ->get();
        return response()->json($students);
    }

    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($student);
    }
}
