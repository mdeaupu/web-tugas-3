<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoriesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Category([
            'category' => $row['nama_kategori'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_kategori' => 'required|string|max:255|unique:categories,category',
        ];
    }
}
