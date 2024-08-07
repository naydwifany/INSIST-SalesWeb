<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
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
                'NameUser' => 'Super Admin 1',
                'EmailUser' => 'superadmin1@insist.co.id',
                'MobilePhoneUser' => '081234567890',
                'SecurityQuestion' => 'Who is your favorite singer?',
                'Answer' => 'Conan Gray',
                'Password' => Hash::make('superadminsatu'),
                'UserPosition' => 'Super Admin',
                'UserStatus' => 'Approve',
            ],
            [
                'NameUser' => 'Super Admin 2',
                'EmailUser' => 'superadmin2@insist.co.id',
                'MobilePhoneUser' => '081324567890',
                'SecurityQuestion' => 'What is your favorite pet?',
                'Answer' => 'Cat',
                'Password' => Hash::make('superadmindua'),
                'UserPosition' => 'Super Admin',
                'UserStatus' => 'Approve',
            ],
        ];

        foreach ($superAdmins as $admin) {
            User::create($admin);
        }
    }
}
