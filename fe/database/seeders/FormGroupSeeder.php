<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Form;
use App\Models\Element;
use App\Models\Formula;
use App\Models\FormGroup;

class FormGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $form_id = Form::first()->id;
        $element_id = Element::first()->id;
        $formula_id = Formula::first()->id;

        $datas = [
            [
                'form_id' => $form_id,
                'element_id' => $element_id,
                'formula_id' => $formula_id,
                'title' => 'Sistem Manajemen Gedung Terpadu',
                'sequence' => 1,
            ]
        ];

        foreach ($datas as $data) {
            if (!FormGroup::where('title', $data['title'])->exists()) {
                FormGroup::create([
                    'form_id' => $data['form_id'],
                    'element_id' => $data['element_id'],
                    'formula_id' => $data['formula_id'],
                    'title' => $data['title'],
                    'sequence' => $data['sequence'],
                ]);
            }
        }
    }
}
