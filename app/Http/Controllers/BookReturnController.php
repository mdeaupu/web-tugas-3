<?php

namespace App\Http\Controllers;

use App\Models\BookReturn;
use App\Models\LoanDetail;
use Illuminate\Http\Request;

class BookReturnController extends Controller
{
    public function index()
    {
        $returns = BookReturn::with('loanDetail.book', 'loanDetail.loan.user')->orderBy('id', 'desc')->paginate(10);
        return view('book_returns.index', compact('returns'));
    }

    public function create()
    {
        $loanDetails = LoanDetail::with('book', 'loan.user')->where('is_return', false)->get();
        return view('book_returns.create', compact('loanDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'charge' => 'nullable|boolean',
            'amount' => 'nullable|integer|min:0',
        ]);

        $loanDetail = LoanDetail::findOrFail($request->loan_detail_id);
        if ($loanDetail->is_return) {
            return redirect()->back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        $loanDetail->update(['is_return' => true]);

        BookReturn::create([
            'loan_detail_id' => $request->loan_detail_id,
            'charge' => $request->charge ?? false,
            'amount' => $request->amount ?? 0,
        ]);

        return redirect()->route('book_returns.index')->with('success', 'Pengembalian berhasil dicatat.');
    }

    public function edit(BookReturn $bookReturn)
    {
        $loanDetails = LoanDetail::with('book', 'loan.user')->get();
        return view('book_returns.edit', compact('bookReturn', 'loanDetails'));
    }

    public function update(Request $request, BookReturn $bookReturn)
    {
        $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'charge' => 'nullable|boolean',
            'amount' => 'nullable|integer|min:0',
        ]);

        $bookReturn->update([
            'loan_detail_id' => $request->loan_detail_id,
            'charge' => $request->charge ?? false,
            'amount' => $request->amount ?? 0,
        ]);

        $loanDetail = LoanDetail::find($request->loan_detail_id);
        if ($loanDetail && !$loanDetail->is_return) {
            $loanDetail->update(['is_return' => true]);
        }

        return redirect()->route('book_returns.index')->with('success', 'Data pengembalian diperbarui.');
    }

    public function destroy(BookReturn $bookReturn)
    {
        $bookReturn->delete();
        return redirect()->route('book_returns.index')->with('success', 'Data pengembalian dihapus.');
    }
}
