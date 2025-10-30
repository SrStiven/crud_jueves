<?php

namespace App\Imports;

use App\Models\Books;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Books([
            'name' => $row['name'],
            'title' => $row['title'],
            'count' => $row['count'],
            'gender' => $row['gender'],
            'due_date' => $row['due_date'],
        ]);
    }
}
