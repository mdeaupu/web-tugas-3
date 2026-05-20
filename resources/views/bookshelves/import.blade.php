<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Import Rak Buku dari Excel</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('bookshelves.import-excel') }}" enctype="multipart/form-data">
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
                        <p>Kolom header (baris pertama) harus mengandung:</p>
                        <ul class="list-disc ml-5 mt-1">
                            <li><strong>kode_rak</strong> (wajib, max 10 karakter, unik)</li>
                            <li><strong>nama_rak</strong> (wajib, max 255 karakter)</li>
                        </ul>
                        <p class="mt-2"><a href="{{ route('bookshelves.export-excel') }}"
                                class="text-indigo-600 hover:underline">Download template contoh</a> (export data kosong
                            atau isi contoh).</p>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('bookshelves.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>