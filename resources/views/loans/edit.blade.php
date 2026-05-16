<x-app-layout>
    <x-slot name="header">Edit Peminjaman #{{ $loan->id }}</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('loans.update', $loan) }}">
                    @csrf
                    @method('PUT')
                    <x-select name="user_npm" label="Peminjam" :options="$users->mapWithKeys(fn($user) => [$user->npm => $user->first_name . ' ' . $user->last_name . ' (' . $user->npm . ')'])->toArray()"
                        :selected="$loan->user_npm" required />
                    <x-input name="loan_at" label="Tanggal Pinjam" type="date" :value="$loan->loan_at" required />
                    <x-input name="return_at" label="Tanggal Jatuh Tempo" type="date" :value="$loan->return_at"
                        required />

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Buku yang Dipinjam</label>
                        <select name="book_ids[]" multiple
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" @if(in_array($book->id, $selectedBooks)) selected @endif>
                                    {{ $book->title }} ({{ $book->bookshelf->name ?? 'Tanpa Rak' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end"><x-button>Update</x-button></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>