<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToCollection, SkipsEmptyRows, WithMultipleSheets, WithValidation, WithStartRow
{
    public function collection(Collection $row)
    {
        return new Student([
            'name' => $row[0],
            'class' => $row[1],
            'level' => $row[2],
            'parent_contact' => $row[3],
        ]);
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string',
            '1' => 'required|string',
            '2' => 'required|string',
            '3' => 'required|string',
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
