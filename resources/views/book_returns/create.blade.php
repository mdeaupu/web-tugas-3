<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Pengembalian Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('book_returns.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="loan_detail_id" class="block text-sm font-medium text-gray-700">Peminjaman
                            Buku</label>
                        <select name="loan_detail_id" id="loan_detail_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required>
                            <option value="">-- Pilih Peminjaman Buku --</option>
                            @foreach($loanDetails as $detail)
                                <option value="{{ $detail->id }}" {{ old('loan_detail_id') == $detail->id ? 'selected' : '' }}>
                                    {{ $detail->book->title }} - Dipinjam oleh {{ $detail->loan->user->first_name }}
                                    {{ $detail->loan->user->last_name }} ({{ $detail->loan->user->npm }})
                                </option>
                            @endforeach
                        </select>
                        @error('loan_detail_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="charge" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('charge') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Kenakan Denda?</span>
                        </label>
                    </div>

                    <div id="amount-field" class="mb-4" style="{{ old('charge') ? '' : 'display: none;' }}">
                        <x-input name="amount" label="Jumlah Denda" type="number" :value="old('amount', 0)" />
                    </div>

                    <div class="flex justify-end">
                        <x-button>Simpan</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.querySelector('input[name="charge"]');
            const amountDiv = document.getElementById('amount-field');
            if (checkbox && amountDiv) {
                checkbox.addEventListener('change', function () {
                    amountDiv.style.display = this.checked ? 'block' : 'none';
                });
            }
        });
    </script>
</x-app-layout>