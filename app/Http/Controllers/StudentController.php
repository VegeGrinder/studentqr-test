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
        $existingStudents = $request->input('existing_students', '');
        $fileName = 'test_file.xlsx';

        if (empty($newStudentsFile)) {
            return response()->json([
                'message' => 'No file uploaded'
            ]);
        }

        Storage::disk('public')->putFileAs('', $newStudentsFile, $fileName);
        $data = Excel::toCollection(new StudentsImport, Storage::disk('public')->path($fileName));

        Storage::disk('public')->delete($fileName);

        return response()->json([
            'message' => 'Upload complete',
            'html' => view('students-data', ['rows' => $data[0]])->render()
        ]);
    }
}
