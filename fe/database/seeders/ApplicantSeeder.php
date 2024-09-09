<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Applicant;
use App\Models\Role;
use App\Models\User;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applicantRole = Role::where('name', 'applicant')->first();
        $user = User::where('role_id', $applicantRole->uuid)->first();
        if ($user && !Applicant::where('user_id', $user->id)->exists()) {
            Applicant::create([
                'user_id' => $user->id,
                'company_name' => 'PT. DIMDEVS INT',
                'address' => 'Kab. Bogor, Kec. Cibungbulang 16630',
                'gender' => 'male',
                'phone' => '08951616162',
            ]);
        }
    }

}
