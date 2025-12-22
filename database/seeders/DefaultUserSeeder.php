<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// php artisan db:seed --class=DefaultUserSeeder
class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('123456'), // enkripsi password tanpa bisa di deskripsi
            'role' => UserRole::OWNER
        ]);
        User::create([
            'name' => 'Cashier',
            'email' => 'cashier@gmail.com',
            'password' => Hash::make('12346'),
            'role' => UserRole::CASHIER
        ]);
    }
}
