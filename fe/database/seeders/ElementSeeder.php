<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Element;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Sistem Dasar',
            ],
            [
                'name' => 'Sistem Kontrol Akses',
            ],
            [
                'name' => 'Sistem Komunikasi',
            ],
            [
                'name' => 'Sistem Energi',
            ],
            [
                'name' => 'Sistem Keselamatan',
            ],
            [
                'name' => 'Sistem Pemanasan, Ventilasi, dan Pendingin Udara (HVAC)',
            ],
            [
                'name' => 'Sistem Pencahayaan',
            ],
            [
                'name' => 'Sistem Mobilitas',
            ],
            [
                'name' => 'Sistem Keamanan',
            ],
            [
                'name' => 'Sistem Sumber Daya',
            ]
        ];

        foreach ($datas as $data) {
            if (!Element::where('name', $data['name'])->exists()) {
                Element::create([
                    'name' => $data['name'],
                ]);
            }
        }
    }
}
