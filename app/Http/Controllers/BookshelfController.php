<?php

namespace App\Http\Controllers;

use App\Exports\BookshelvesExport;
use App\Imports\BookshelvesImport;
use App\Models\Bookshelf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookshelfController extends Controller
{
    public function index()
    {
        $bookshelves = Bookshelf::orderBy('id', 'desc')->paginate(10);
        return view('bookshelves.index', compact('bookshelves'));
    }

    public function create()
    {
        return view('bookshelves.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:bookshelfs,code',
            'name' => 'required|string|max:255',
        ]);

        Bookshelf::create($validated);
        return redirect()->route('bookshelves.index')->with('success', 'Rak buku berhasil ditambahkan.');
    }

    public function edit(Bookshelf $bookshelf)
    {
        return view('bookshelves.edit', compact('bookshelf'));
    }

    public function update(Request $request, Bookshelf $bookshelf)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:bookshelfs,code,' . $bookshelf->id,
            'name' => 'required|string|max:255',
        ]);

        $bookshelf->update($validated);
        return redirect()->route('bookshelves.index')->with('success', 'Rak buku berhasil diperbarui.');
    }

    public function destroy(Bookshelf $bookshelf)
    {
        if ($bookshelf->books()->count() > 0) {
            return redirect()->route('bookshelves.index')->with('error', 'Rak tidak bisa dihapus karena masih memiliki buku.');
        }
        $bookshelf->delete();
        return redirect()->route('bookshelves.index')->with('success', 'Rak buku berhasil dihapus.');
    }

    public function printPDF()
    {
        $bookshelves = Bookshelf::orderBy('id')->get();
        $pdf = Pdf::loadView('bookshelves.pdf', compact('bookshelves'));
        return $pdf->download('daftar-rak-buku.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new BookshelvesExport(), 'daftar-rak-buku.xlsx');
    }

    public function importForm()
    {
        return view('bookshelves.import');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new BookshelvesImport(), $request->file('file'));
            return redirect()->route('bookshelves.index')->with('success', 'Data rak buku berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
