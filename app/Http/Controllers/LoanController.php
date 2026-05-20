<?php

namespace App\Http\Controllers;

use App\Exports\LoansExport;
use App\Models\Book;
use App\Models\BookReturn;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $users = User::orderBy('npm')->get();
        $books = Book::with('bookshelf')->orderBy('title')->get();
        return view('loans.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_npm' => 'required|exists:users,npm',
            'loan_at' => 'required|date',
            'return_at' => 'required|date|after:loan_at',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,id',
        ]);

        DB::beginTransaction();
        try {
            $loan = Loan::create([
                'user_npm' => $request->user_npm,
                'loan_at' => $request->loan_at,
                'return_at' => $request->return_at,
            ]);

            foreach ($request->book_ids as $bookId) {
                LoanDetail::create([
                    'loan_id' => $loan->id,
                    'book_id' => $bookId,
                    'is_return' => false,
                ]);
            }

            DB::commit();
            return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan peminjaman: ' . $e->getMessage());
        }
    }

    public function show(Loan $loan)
    {
        $loan->load('user', 'loanDetails.book', 'loanDetails.returnRecord');
        return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        $users = User::orderBy('npm')->get();
        $books = Book::with('bookshelf')->orderBy('title')->get();
        $selectedBooks = $loan->loanDetails->pluck('book_id')->toArray();
        return view('loans.edit', compact('loan', 'users', 'books', 'selectedBooks'));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'user_npm' => 'required|exists:users,npm',
            'loan_at' => 'required|date',
            'return_at' => 'required|date|after:loan_at',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,id',
        ]);

        DB::beginTransaction();
        try {
            $loan->update([
                'user_npm' => $request->user_npm,
                'loan_at' => $request->loan_at,
                'return_at' => $request->return_at,
            ]);

            $oldBookIds = $loan->loanDetails->pluck('book_id')->toArray();
            $toDelete = array_diff($oldBookIds, $request->book_ids);
            if (!empty($toDelete)) {
                LoanDetail::where('loan_id', $loan->id)->whereIn('book_id', $toDelete)->delete();
            }

            $toAdd = array_diff($request->book_ids, $oldBookIds);
            foreach ($toAdd as $bookId) {
                LoanDetail::create([
                    'loan_id' => $loan->id,
                    'book_id' => $bookId,
                    'is_return' => false,
                ]);
            }

            DB::commit();
            return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui peminjaman.');
        }
    }

    public function destroy(Loan $loan)
    {
        if ($loan->loanDetails()->where('is_return', true)->exists()) {
            return redirect()->route('loans.index')->with('error', 'Tidak dapat menghapus peminjaman yang sudah ada pengembalian.');
        }
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function returnBook(Request $request, LoanDetail $loanDetail)
    {
        $request->validate([
            'charge' => 'nullable|boolean',
            'amount' => 'nullable|integer|min:0',
        ]);

        if ($loanDetail->is_return) {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan.');
        }

        DB::beginTransaction();
        try {
            $loanDetail->update(['is_return' => true]);

            BookReturn::create([
                'loan_detail_id' => $loanDetail->id,
                'charge' => $request->charge ?? false,
                'amount' => $request->amount ?? 0,
            ]);

            DB::commit();
            return redirect()->route('loans.show', $loanDetail->loan_id)->with('success', 'Buku berhasil dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mencatat pengembalian.');
        }
    }

    public function printPDF()
    {
        $loans = Loan::with(['user', 'loanDetails.book'])->orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('loans.pdf', compact('loans'));
        return $pdf->download('laporan-peminjaman.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new LoansExport(), 'laporan-peminjaman.xlsx');
    }
}
