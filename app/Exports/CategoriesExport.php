<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CategoriesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Category::orderBy('id')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Kategori',
            'Dibuat Tanggal',
            'Diperbarui Tanggal',
        ];
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->category,
            $category->created_at,
            $category->updated_at,
        ];
    }
}
