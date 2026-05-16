<x-app-layout>
    <x-slot name="header">Manajemen Peminjaman</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('loans.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah
                        Peminjaman</a>
                </div>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                            <tr>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->user->first_name }} {{ $loan->user->last_name }} ({{ $loan->user->npm }})</td>
                                <td>{{ $loan->loan_at }}</td>
                                <td>{{ $loan->return_at }}</td>
                                <td>
                                    <a href="{{ route('loans.show', $loan) }}" class="text-green-600 mr-2">Detail</a>
                                    <a href="{{ route('loans.edit', $loan) }}" class="text-indigo-600 mr-2">Edit</a>
                                    <x-delete-button route="{{ route('loans.destroy', $loan) }}" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $loans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>