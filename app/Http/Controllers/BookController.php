<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['bookshelf', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $bookshelves = Bookshelf::all();
        $categories = Category::all();
        return view('books.create', compact('bookshelves', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'publisher' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bookshelf_id' => 'required|exists:bookshelfs,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $path;
        } else {
            $validated['cover'] = 'covers/default.jpg';
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $bookshelves = Bookshelf::all();
        $categories = Category::all();
        return view('books.edit', compact('book', 'bookshelves', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'publisher' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bookshelf_id' => 'required|exists:bookshelfs,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover && $book->cover !== 'covers/default.jpg') {
                Storage::disk('public')->delete($book->cover);
            }
            $path = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $path;
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover && $book->cover !== 'covers/default.jpg') {
            Storage::disk('public')->delete($book->cover);
        }
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
