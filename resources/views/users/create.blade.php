<x-app-layout>
    <x-slot name="header">Tambah User</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <x-input name="npm" label="NPM" required />
                    <x-input name="username" label="Username" required />
                    <x-input name="first_name" label="First Name" required />
                    <x-input name="last_name" label="Last Name" required />
                    <x-input name="email" label="Email" type="email" required />
                    <x-input name="password" label="Password" type="password" required />
                    <x-input name="password_confirmation" label="Konfirmasi Password" type="password" required />
                    <x-select name="role" label="Role" :options="$roles->pluck('name', 'name')->toArray()" required />
                    <div class="flex justify-end"><x-button>Simpan</x-button></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>