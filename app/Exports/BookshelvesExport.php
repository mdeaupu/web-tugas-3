<?php

namespace App\Exports;

use App\Models\Bookshelf;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookshelvesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Bookshelf::orderBy('id')->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Kode Rak',
            'Nama Rak',
        ];
    }

    public function map($bookshelf): array
    {
        return [
            $bookshelf->id,
            $bookshelf->code,
            $bookshelf->name,
        ];
    }
}
