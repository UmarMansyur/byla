<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
            'thumbnail' => 'https://ik.imagekit.io/8zmr0xxik/blob_c2rRi4vdU?updatedAt=1709077347010',
            'birthday' => '2000-01-01',
            'gender' => 'male',
            'address' => 'Jl. Admin',
        ]);
        User::factory(100)->create();
        
    }
}
