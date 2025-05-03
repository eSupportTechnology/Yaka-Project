<?php

namespace Database\Seeders;

use App\Models\UserPhoneNumber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPhoneNumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        UserPhoneNumber::create([
            'user_id' => 1,
            'phone_number' => '0712345678', // Primary phone number
            'is_primary' => true,
        ]);

        UserPhoneNumber::create([
            'user_id' => 1,
            'phone_number' => '0712345679', // Non-primary phone number
            'is_primary' => false,
        ]);

        UserPhoneNumber::create([
            'user_id' => 1,
            'phone_number' => '0712345680', // Non-primary phone number
            'is_primary' => false,
        ]);

        // User 2
        UserPhoneNumber::create([
            'user_id' => 2,
            'phone_number' => '0723456781', // Primary phone number
            'is_primary' => true,
        ]);

        UserPhoneNumber::create([
            'user_id' => 2,
            'phone_number' => '0723456782', // Non-primary phone number
            'is_primary' => false,
        ]);

        UserPhoneNumber::create([
            'user_id' => 2,
            'phone_number' => '0723456783', // Non-primary phone number
            'is_primary' => false,
        ]);

        // User 3
        UserPhoneNumber::create([
            'user_id' => 3,
            'phone_number' => '0734567891', // Primary phone number
            'is_primary' => true,
        ]);

        UserPhoneNumber::create([
            'user_id' => 3,
            'phone_number' => '0734567892', // Non-primary phone number
            'is_primary' => false,
        ]);

        UserPhoneNumber::create([
            'user_id' => 3,
            'phone_number' => '0734567893', // Non-primary phone number
            'is_primary' => false,
        ]);
    }
}
