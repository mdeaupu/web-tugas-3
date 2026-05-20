<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BooksImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $bookshelf = Bookshelf::firstOrCreate(
            ['name' => $row['rak_buku']],
            ['name' => $row['rak_buku']]
        );

        $category = null;
        if (!empty($row['kategori'])) {
            $category = Category::firstOrCreate(
                ['category' => $row['kategori']],
                ['category' => $row['kategori']]
            );
        }

        return new Book([
            'title' => $row['judul_buku'],
            'author' => $row['penulis'],
            'year' => $row['tahun_terbit'],
            'publisher' => $row['penerbit'],
            'city' => $row['kota'],
            'cover' => $row['cover'] ?? 'covers/default.jpg',
            'bookshelf_id' => $bookshelf->id,
            'category_id' => $category ? $category->id : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'penerbit' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'rak_buku' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'cover' => 'nullable|string|max:255',
        ];
    }
}
