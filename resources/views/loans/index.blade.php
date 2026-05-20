<x-app-layout>
    <x-slot name="header">Manajemen Peminjaman</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <div class="mb-4 flex justify-end">
                    <div class="mb-4 flex justify-end space-x-2">
                        <a href="{{ route('loans.create') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Tambah
                            Peminjaman</a>
                        <a href="{{ route('loans.print-pdf') }}" target="_blank"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cetak PDF</a>
                        <a href="{{ route('loans.export-excel') }}"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Export
                            Excel</a>
                    </div>
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