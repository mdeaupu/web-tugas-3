<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Book::with(['bookshelf', 'category'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul Buku',
            'Penulis',
            'Tahun Terbit',
            'Penerbit',
            'Kota',
            'Cover',
            'Rak Buku',
            'Kategori',
            'Dibuat Tanggal',
            'Diperbarui Tanggal'
        ];
    }

    public function map($book): array
    {
        return [
            $book->id,
            $book->title,
            $book->author,
            $book->year,
            $book->publisher,
            $book->city,
            $book->cover,
            $book->bookshelf->name ?? '',
            $book->category->category ?? '',
            $book->created_at,
            $book->updated_at,
        ];
    }
}
