<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                    @csrf
                    <x-input name="title" label="Judul Buku" required />
                    <x-input name="author" label="Penulis" required />
                    <x-input name="year" label="Tahun Terbit" type="number" required />
                    <x-input name="publisher" label="Penerbit" required />
                    <x-input name="city" label="Kota" required />
                    <x-input name="cover" label="Cover Buku" type="file" />
                    <x-select name="bookshelf_id" label="Rak Buku" :options="$bookshelves->pluck('name', 'id')->toArray()" required />
                    <x-select name="category_id" label="Kategori" :options="$categories->pluck('category', 'id')->toArray()" />

                    <div class="flex justify-end">
                        <x-button>Simpan</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>