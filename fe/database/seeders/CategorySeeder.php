<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'BGC',
            ],
            [
                'name' => 'NON BGC',
            ]
        ];

        foreach ($datas as $data) {
            if (!Category::where('name', $data['name'])->exists()) {
                Category::create([
                    'name' => $data['name'],
                ]);
            }
        }
    }
}
