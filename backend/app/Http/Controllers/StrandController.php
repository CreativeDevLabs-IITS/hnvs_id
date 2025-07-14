<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Strand;
use App\Models\Section;
use Exception;

use function PHPUnit\Framework\isEmpty;

class StrandController extends Controller
{
    public function list() {
        return response()->json([
            'strands' => Strand::all()
        ]);
    }

    public function create(Request $request) {
        try {
            $validate = $request->validate([
                'description' => 'nullable',
                'track' => 'required',
                'specialization' => 'nullable',
                'cluster' => 'nullable'
            ]);

            if($request->track == 0 && empty($request->academicClusterName)) {
                return response()->json([
                    'error' => 'Cluster name is required'
                ]);
            }

            if($request->track == 0 && empty($request->cluster)) {
                $validate['cluster'] = $request->academicClusterName;
            }

            if($request->track == 1 && (!filled($request->cluster) || empty($request->specialization))) {
                return response()->json([
                    'error' => 'TechPro cluster and Specialization are both required'
                ]);
            }

            Strand::create($validate);
            return response()->json([
                'message' => 'Strand added.'
            ]);
        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request) {
        try {
            $strand = Strand::find($request->id);
            $validate = $request->validate([
                'name' => 'nullable',
                'description' => 'nullable',
                'track' => 'nullable',
                'specialization' => 'nullable',
                'cluster' => 'nullable',
            ]);

            if($request->track == 0 && empty($request->cluster)) {
                $validate['cluster'] = $request->academicName;
            }

            if($request->track == 1 && (!filled($request->cluster) || empty($request->specialization))) {
                return response()->json([
                    'error' => 'TechPro cluster and Specialization are both required'
                ]);
            }

            $strand->update($validate);
            return response()->json([
                'message' => 'Strand updated.'
            ]);
        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request) {
        try {
            $strand = Strand::find($request->id);
            $strand->delete();
            return response()->json([
                'message' => 'Strand deleted.'
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function find(Request $request) {
        $strand = Strand::find($request->id);
        return response()->json([
            'strand' => $strand
        ]);
    }



    // sections
    public function addSection(Request $request) {
        try {
            $validate = $request->validate([
                'name' => 'required'
            ]);
            $section = Section::create($validate);
            return response()->json([
                'message' => 'Section addedd successfully'
            ]);
        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function sectionList() {
        return response()->json([
            'sections' => Section::all()
        ]);
    }

    public function editSection(Request $request) {
        try {
            $section = Section::find($request->id);

            $validate = $request->validate([
                'name' => 'nullable'
            ]);
            $section->update($validate);

            return response()->json([
                'message' => 'Section editted successfully'
            ]);
        }catch(ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function deleteSection(Request $request) {
        try {
            $section = Section::find($request->id);
            $section->delete();
            return response()->json([
                'message' => 'Section deleted successfully.'
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
