<?php

namespace App\Exports;

use App\Models\BookReturn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookReturnsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BookReturn::with('loanDetail.book', 'loanDetail.loan.user')->orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Buku',
            'Peminjam (NPM)',
            'Tanggal Pinjam',
            'Tanggal Jatuh Tempo',
            'Tanggal Pengembalian',
            'Denda',
            'Jumlah Denda',
        ];
    }

    public function map($return): array
    {
        $loanDetail = $return->loanDetail;
        $loan = $loanDetail->loan ?? null;
        $book = $loanDetail->book ?? null;

        return [
            $return->id,
            $book->title ?? '-',
            ($loan->user->first_name ?? '') . ' ' . ($loan->user->last_name ?? '') . ' (' . ($loan->user->npm ?? '') . ')',
            $loan->loan_at ?? '-',
            $loan->return_at ?? '-',
            $return->created_at ?? '-',
            $return->charge ? 'Ya' : 'Tidak',
            number_format($return->amount, 0, ',', '.'),
        ];
    }
}
