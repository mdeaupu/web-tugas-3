<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::with('roles')->orderBy('npm')->get();
    }

    public function headings(): array
    {
        return [
            'NPM',
            'Username',
            'First Name',
            'Last Name',
            'Email',
            'Role',
        ];
    }

    public function map($user): array
    {
        return [
            $user->npm,
            $user->username,
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->roles->pluck('name')->implode(', '),
        ];
    }
}
