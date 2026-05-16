<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Rak Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('bookshelves.update', $bookshelf) }}">
                    @csrf
                    @method('PUT')
                    <x-input name="code" label="Kode Rak" :value="$bookshelf->code" required />
                    <x-input name="name" label="Nama Rak" :value="$bookshelf->name" required />

                    <div class="flex justify-end">
                        <x-button>Update</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>