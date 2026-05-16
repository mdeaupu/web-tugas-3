<x-app-layout>
    <x-slot name="header">Data Pengembalian & Denda</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('book_returns.create') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah Pengembalian</a>
                </div>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Loan Detail</th>
                            <th>Buku</th>
                            <th>Denda</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returns as $return)
                            <tr>
                                <td>{{ $return->id }}</td>
                                <td>{{ $return->loan_detail_id }}</td>
                                <td>{{ $return->loanDetail->book->title ?? '-' }}</td>
                                <td>{{ $return->charge ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ number_format($return->amount, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('book_returns.edit', $return) }}"
                                        class="text-indigo-600 mr-2">Edit</a>
                                    <x-delete-button route="{{ route('book_returns.destroy', $return) }}" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $returns->links() }}
            </div>
        </div>
    </div>
</x-app-layout>