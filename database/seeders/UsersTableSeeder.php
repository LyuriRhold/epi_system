<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create a default user
        DB::table('users')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'employee_id' => 'EMP001',
            'email' => 'john@example.com',
            'gender' => 'male',
            'password' => Hash::make('secret'), // Hash the password
            'address' => '123 Main St',
            'birth_day' => '1990-01-01',
            'phone_number' => '1234567890',
            'position' => 'Developer',
            'department' => 'IT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
