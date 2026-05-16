<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input name="title" label="Judul Buku" :value="$book->title" required />
                    <x-input name="author" label="Penulis" :value="$book->author" required />
                    <x-input name="year" label="Tahun Terbit" type="number" :value="$book->year" required />
                    <x-input name="publisher" label="Penerbit" :value="$book->publisher" required />
                    <x-input name="city" label="Kota" :value="$book->city" required />

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Cover Saat Ini</label>
                        <img src="{{ asset('storage/' . $book->cover) }}" class="h-20 w-20 object-cover rounded mt-1">
                    </div>
                    <x-input name="cover" label="Ganti Cover (opsional)" type="file" />

                    <x-select name="bookshelf_id" label="Rak Buku" :options="$bookshelves->pluck('name', 'id')->toArray()" :selected="$book->bookshelf_id" required />
                    <x-select name="category_id" label="Kategori" :options="$categories->pluck('category', 'id')->toArray()" :selected="$book->category_id" />

                    <div class="flex justify-end">
                        <x-button>Update</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>