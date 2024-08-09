<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminINSISTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmins = [
            [
                'NameUser' => 'Rahmat Yusufi',
                'EmailUser' => 'rahmat.yusufi@insist.co.id',
                'MobilePhoneUser' => '085766029922',
                'SecurityQuestion' => 'nama hewan peliharaan',
                'Answer' => 'Jiban',
                'Password' => Hash::make('ISTdata2024#@!'),
                'UserPosition' => 'Super Admin',
                'UserStatus' => 'Approve',
            ],
            [
                'NameUser' => 'reginaanwar',
                'EmailUser' => 'regina.anwar@insist.co.id',
                'MobilePhoneUser' => '081388815860',
                'SecurityQuestion' => 'office cat name',
                'Answer' => 'Mario',
                'Password' => Hash::make('Alestra2024#@!'),
                'UserPosition' => 'Super Admin',
                'UserStatus' => 'Approve',
            ],
        ];

        foreach ($superAdmins as $admin) {
            User::create($admin);
        }
    }
}