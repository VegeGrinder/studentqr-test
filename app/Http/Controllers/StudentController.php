<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('students');
    }

    public function template()
    {

    }

    public function upload(Request $request)
    {
        $newStudents = $request->input('new_students', '');
        $existingStudents = $request->input('existing_students', '');
    }
}
