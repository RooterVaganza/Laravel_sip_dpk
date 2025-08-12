<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        user::trumcate();
        
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password'=> Hash::make('12345678'),
            'role' => User::ADMIN_ROLE
        ]);
    }
}
