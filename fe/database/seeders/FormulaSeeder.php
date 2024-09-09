<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Formula;
use App\Models\Category;

class FormulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $BGN = Category::where('name' , 'BGC')->first();
        $NONBGN = Category::where('name' , 'NON BGC')->first();

        $datas = [
            [
                'matrix' => 'Wajib',
                'value' => 3,
                'category_id' => $BGN->id
            ],
            [
                'matrix' => 'Disarankan',
                'value' => 2,
                'category_id' => $BGN->id
            ],
            [
                'matrix' => 'Tidak Wajib',
                'value' => 1,
                'category_id' => $BGN->id
            ],
            [
                'matrix' => 'Wajib',
                'value' => 3,
                'category_id' => $NONBGN->id
            ],
            [
                'matrix' => 'Disarankan',
                'value' => 2,
                'category_id' => $NONBGN->id
            ],
            [
                'matrix' => 'Tidak Wajib',
                'value' => 1,
                'category_id' => $NONBGN->id
            ],
        ];

        foreach ($datas as $data) {
            if (!Formula::where([
                'matrix' => $data['matrix'],
                'value' => $data['value'],
                'category_id' => $data['category_id']
            ])->exists()) {
                Formula::create([
                    'matrix' => $data['matrix'],
                    'value' => $data['value'],
                    'category_id' => $data['category_id'],
                ]);
            }
        }
    }
}
