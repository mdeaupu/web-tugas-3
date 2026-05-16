<x-app-layout>
    <x-slot name="header">Edit User</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <x-input name="username" label="Username" :value="$user->username" required />
                    <x-input name="first_name" label="First Name" :value="$user->first_name" required />
                    <x-input name="last_name" label="Last Name" :value="$user->last_name" required />
                    <x-input name="email" label="Email" type="email" :value="$user->email" required />
                    <x-input name="password" label="Password (kosongkan jika tidak diubah)" type="password" />
                    <x-input name="password_confirmation" label="Konfirmasi Password" type="password" />
                    <x-select name="role" label="Role" :options="$roles->pluck('name', 'name')->toArray()"
                        :selected="$user->roles->first()->name ?? ''" required />
                    <div class="flex justify-end"><x-button>Update</x-button></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>