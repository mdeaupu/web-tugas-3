<x-app-layout>
    <x-slot name="header">Edit Pengembalian</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('book_returns.update', $bookReturn) }}">
                    @csrf
                    @method('PUT')
                    <x-select name="loan_detail_id" label="Detail Peminjaman"
                        :options="$loanDetails->mapWithKeys(fn($ld) => [$ld->id => $ld->book->title . ' - ' . $ld->loan->user->first_name])->toArray()" :selected="$bookReturn->loan_detail_id" required />
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="charge" value="1" @if($bookReturn->charge) checked @endif>
                            Kenakan Denda?
                        </label>
                    </div>
                    <x-input name="amount" label="Jumlah Denda" type="number" :value="$bookReturn->amount" />
                    <div class="flex justify-end"><x-button>Update</x-button></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>