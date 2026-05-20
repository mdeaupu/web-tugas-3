<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Import Buku dari Excel</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('books.import-excel') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">File Excel (xlsx, xls, csv)</label>
                        <input type="file" name="file" class="mt-1 block w-full" required>
                        @error('file')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4 p-3 bg-yellow-50 rounded text-sm">
                        <p class="font-semibold">Format File Excel yang benar:</p>
                        <p>Kolom harus memiliki header (baris pertama):</p>
                        <ul class="list-disc ml-5 mt-1">
                            <li><strong>judul_buku</strong> (wajib)</li>
                            <li><strong>penulis</strong> (wajib)</li>
                            <li><strong>tahun_terbit</strong> (wajib, 4 digit)</li>
                            <li><strong>penerbit</strong> (wajib)</li>
                            <li><strong>kota</strong> (wajib)</li>
                            <li><strong>rak_buku</strong> (wajib, akan dibuat otomatis jika belum ada)</li>
                            <li><strong>kategori</strong> (opsional)</li>
                            <li><strong>cover</strong> (opsional, path cover atau biarkan kosong)</li>
                        </ul>
                        <p class="mt-2"><a href="{{ route('books.export-excel') }}"
                                class="text-indigo-600 hover:underline">Download contoh template</a> (export kosong lalu
                            isi).</p>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('books.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>