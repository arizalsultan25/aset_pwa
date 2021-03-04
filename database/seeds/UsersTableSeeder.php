<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Akun Admin
        User::create([
            'name' => 'Sultan Arizal Mahing',
            'email' => 'arizalsultan25@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'role' => 0,
        ]);

        // Akun Staf
        User::create([
            'name' => 'Ardy Armando',
            'email' => 'ardibelian@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'divisi' => 'Production',
            'role' => 1,
        ]);

        User::create([
            'name' => 'Maulita Rizchita',
            'email' => 'rizchita.p@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'role' => 1,
        ]);

        User::create([
            'name' => 'Deva Rahmat Ladio',
            'email' => 'dev.lad@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'divisi' => 'Human Resource',
            'role' => 1,
        ]);

        User::create([
            'name' => 'Suwardi Putra',
            'email' => 'suarditest@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'divisi' => 'Finance',
            'role' => 1,
        ]);
    }
}
