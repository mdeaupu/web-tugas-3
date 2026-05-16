<x-app-layout>
    <x-slot name="header">Detail Peminjaman #{{ $loan->id }}</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <p><strong>Peminjam:</strong> {{ $loan->user->first_name }} {{ $loan->user->last_name }}
                    ({{ $loan->user->npm }})</p>
                <p><strong>Tanggal Pinjam:</strong> {{ $loan->loan_at }}</p>
                <p><strong>Tanggal Jatuh Tempo:</strong> {{ $loan->return_at }}</p>
                <hr class="my-4">
                <h3 class="font-bold">Daftar Buku</h3>
                <table class="min-w-full mt-2">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loan->loanDetails as $detail)
                            <tr>
                                <td>{{ $detail->book->title }}</td>
                                <td>{{ $detail->is_return ? 'Sudah Dikembalikan' : 'Belum Dikembalikan' }}</td>
                                <td>
                                    @if(!$detail->is_return)
                                        <form method="POST" action="{{ route('loans.return', $detail) }}">
                                            @csrf
                                            <input type="hidden" name="charge" value="0">
                                            <input type="hidden" name="amount" value="0">
                                            <button type="submit"
                                                class="bg-green-500 text-white px-2 py-1 rounded">Kembalikan</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="{{ route('loans.edit', $loan) }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Edit
                        Peminjaman</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>