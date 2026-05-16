<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Rak Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('bookshelves.store') }}">
                    @csrf
                    <x-input name="code" label="Kode Rak" required />
                    <x-input name="name" label="Nama Rak" required />

                    <div class="flex justify-end">
                        <x-button>Simpan</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>