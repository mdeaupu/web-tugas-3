<?php

namespace App\Imports;

use App\Models\Bookshelf;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BookshelvesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Bookshelf([
            'code' => $row['kode_rak'],
            'name' => $row['nama_rak'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_rak' => 'required|string|max:10|unique:bookshelfs,code',
            'nama_rak' => 'required|string|max:255',
        ];
    }
}
