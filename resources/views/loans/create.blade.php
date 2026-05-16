<x-app-layout>
    <x-slot name="header">Tambah Peminjaman</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('loans.store') }}">
                    @csrf
                    <x-select name="user_npm" label="Peminjam" :options="$users->pluck('first_name', 'npm')->map(function ($name, $npm) use ($users) {
    return $name . ' ' . $users->find($npm)->last_name . ' (' . $npm . ')'; })->toArray()" required />
                    <x-input name="loan_at" label="Tanggal Pinjam" type="date" required />
                    <x-input name="return_at" label="Tanggal Jatuh Tempo" type="date" required />

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Buku yang Dipinjam</label>
                        <select name="book_ids[]" multiple
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}
                                    ({{ $book->bookshelf->name ?? 'Tanpa Rak' }})</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500">Tekan Ctrl untuk memilih lebih dari satu</p>
                    </div>

                    <div class="flex justify-end"><x-button>Simpan</x-button></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>