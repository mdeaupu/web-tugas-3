<x-app-layout>
    <x-slot name="header">Detail Peminjaman Buku</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Loan ID</th>
                            <th>Buku</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->loan_id }}</td>
                                <td>{{ $detail->book->title }}</td>
                                <td>{{ $detail->is_return ? 'Kembali' : 'Dipinjam' }}</td>
                                <td><x-delete-button route="{{ route('loan_details.destroy', $detail) }}" /></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $details->links() }}
            </div>
        </div>
    </div>
</x-app-layout>