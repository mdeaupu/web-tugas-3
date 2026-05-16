<?php

namespace App\Http\Controllers;

use App\Models\Bookshelf;
use Illuminate\Http\Request;

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
}
