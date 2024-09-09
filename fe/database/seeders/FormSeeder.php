<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Form;
use App\Models\Category;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $BGC = Category::where('name' , 'BGC')->first()->id;

        $datas = [
            [
                'title' => 'DAFTAR SIMAK MANDIRI (SELF ASSESMENT) BANGUNAN GEDUNG CERDAS (BGC)',
                'type' => 'Sederhana',
                'category_id' => $BGC,
            ],
        ];

        foreach ($datas as $data) {
            if (!Form::where('title', $data['title'])->exists()) {
                Form::create([
                    'title' => $data['title'],
                    'type' => $data['type'],
                    'category_id' => $data['category_id'],
                ]);
            }
        }
    }
}
