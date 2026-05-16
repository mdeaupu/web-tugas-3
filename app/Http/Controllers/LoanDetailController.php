<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use Illuminate\Http\Request;

class LoanDetailController extends Controller
{
    public function index()
    {
        $details = LoanDetail::with('loan', 'book')->orderBy('created_at', 'desc')->paginate(10);
        return view('loan_details.index', compact('details'));
    }

    public function destroy(LoanDetail $loanDetail)
    {
        if ($loanDetail->is_return) {
            return redirect()->route('loan_details.index')->with('error', 'Tidak dapat menghapus detail yang sudah dikembalikan.');
        }
        $loanDetail->delete();
        return redirect()->route('loan_details.index')->with('success', 'Detail peminjaman dihapus.');
    }
}
