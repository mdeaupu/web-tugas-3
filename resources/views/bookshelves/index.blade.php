<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen Rak Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('bookshelves.create') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Tambah Rak</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Rak
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Rak
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bookshelves as $bookshelf)
                                <tr>
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $bookshelf->code }}</td>
                                    <td class="px-6 py-4">{{ $bookshelf->name }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('bookshelves.edit', $bookshelf) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                        <x-delete-button route="{{ route('bookshelves.destroy', $bookshelf) }}" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Tidak ada data rak.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $bookshelves->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>