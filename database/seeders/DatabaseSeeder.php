<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\BankAdmin;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;
use App\Models\UserWallet;
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

        User::create([
            'name' => 'User',
            'user_code' => fake()->unique()->numerify('USR-#####'),
            'password' => Hash::make('user'),
            'email' => 'user@gmail.com',
            'phone' => '081234567890',
            'thumbnail' => 'https://ik.imagekit.io/8zmr0xxik/blob_c2rRi4vdU?updatedAt=1709077347010',
            'birthday' => '2000-01-01',
            'gender' => 'male',
            'address' => 'Jl. User',
            'type_login' => 'email',
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        BankAdmin::create([
            'admin_id' => 1,
            'bank_name' => 'BCA',
            'rekening' => '1234567890',
            'bank_account_number' => 'BRI',
            'bank_account_name' => 'Umar',
        ]);

        Merchant::create([
            'user_id' => 1,
            'merchant_code' => fake()->unique()->numerify('MCH-#####'),
            'name' => 'Toko A',
            'address' => 'Jl. Merchant',
        ]);
        Product::factory(20)->create();
    }
}
