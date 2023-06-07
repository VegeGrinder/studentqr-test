<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        return view('students');
    }

    public function template()
    {
        return Storage::download('downloads/template_students.xlsx');
    }

    public function upload(Request $request)
    {
        $newStudentsFile = $request->file('new_students_file', '');
        $existingStudents = json_decode($request->input('existing_students', ''));
        $isSpecialUnique = $request->file('is_special_unique', false);
        $fileName = 'test_file.xlsx';

        if (empty($newStudentsFile)) {
            return response()->json([
                'message' => 'No file uploaded'
            ]);
        }

        Storage::disk('public')->putFileAs('', $newStudentsFile, $fileName);
        $data = Excel::toCollection(new StudentsImport, Storage::disk('public')->path($fileName))[0];
        $data = $data->map(function ($item, $key) {
            return $item->slice(0, 4);
        });
        Storage::disk('public')->delete($fileName);

        if (!empty($existingStudents)) {
            $data = collect($existingStudents)->merge($data);
        }

        $data = $data->unique(function ($item) use ($isSpecialUnique) {
            return $isSpecialUnique
                ? $item[0].$item[3]
                : $item[0].$item[1].$item[2].$item[3];
        });

        return response()->json([
            'message' => 'Upload complete',
            'html' => view('students-data', ['rows' => $data])->render(),
            'data' => json_encode($data)
        ]);
    }
}
