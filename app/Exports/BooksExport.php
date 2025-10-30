<?php

namespace App\Exports;

use App\Models\Books;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Books::select('name', 'title', 'count', 'gender', 'due_date')->get();
    }

    public function headings(): array
    {
        return [
            'name',
            'title',
            'count',
            'gender',
            'due_date',
        ];
    }
}
