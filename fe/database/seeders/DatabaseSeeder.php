<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ElementSeeder::class,
            CategorySeeder::class,
            FormulaSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            ApplicantSeeder::class,
            FormSeeder::class,
            FormGroupSeeder::class,
        ]);
    }
}
