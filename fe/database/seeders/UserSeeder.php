<?php

namespace Database\Seeders;

// Library
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;


// Models
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::whereIn('name', ['admin', 'super_admin', 'checker', 'applicant'])
            ->pluck('uuid', 'name')
            ->toArray();

        $users = [
            [
                'name' => 'Admin Smart Building',
                'email' => 'admin@ikn.go.id',
                'phone' => '089516116283',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Super Admin Smart Building',
                'email' => 'super.admin@ikn.go.id',
                'phone' => '089516116282',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
            ],
            [
                'name' => 'Checker Smart Building',
                'email' => 'checker@ikn.go.id',
                'phone' => '089516116281',
                'password' => Hash::make('checker123'),
                'role' => 'checker',
            ],
            [
                'name' => 'Applicant Smart Building',
                'email' => 'applicant@ikn.go.id',
                'phone' => '089516116280',
                'password' => Hash::make('applicant123'),
                'role' => 'applicant',
            ],
        ];

        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'password' => $user['password'],
                    'role_id' => $roles[$user['role']],
                ]);
            }
        }
    }
}
