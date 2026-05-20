<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoansExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Loan::with(['user', 'loanDetails'])->orderBy('id', 'desc')->get();

    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Peminjam',
            'NPM',
            'Tanggal Pinjam',
            'Tanggal Jatuh Tempo',
            'Jumlah Buku',
            'Buku yang Dipinjam',
            'Status',
        ];
    }

    public function map($loan): array
    {
        $bookTitles = $loan->loanDetails->map(function ($detail) {
            return $detail->book->title ?? 'Buku dihapus';
        })->implode(', ');

        $totalBooks = $loan->loanDetails->count();
        $returnedCount = $loan->loanDetails->where('is_return', true)->count();
        $status = ($returnedCount == $totalBooks) ? 'Semua Dikembalikan' : ($returnedCount > 0 ? 'Sebagian Kembali' : 'Belum Ada Pengembalian');

        return [
            $loan->id,
            $loan->user->first_name . ' ' . $loan->user->last_name,
            $loan->user->npm,
            $loan->loan_at,
            $loan->return_at,
            $totalBooks,
            $bookTitles,
            $status,
        ];
    }
}
