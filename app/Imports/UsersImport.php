<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $user = User::create([
            'npm' => $row['npm'],
            'username' => $row['username'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'password' => Hash::make('password123'),
        ]);

        if (!empty($row['role']) && Role::where('name', $row['role'])->exists()) {
            $user->assignRole($row['role']);
        } else {
            $user->assignRole('user');
        }

        return $user;
    }

    public function rules(): array
    {
        return [
            'npm' => 'required|integer|unique:users,npm',
            'username' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'nullable|string|exists:roles,name',
        ];
    }
}
