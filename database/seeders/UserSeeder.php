<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        for($i = 0; $i < 15; $i++){
            $users[] = [
                'name' => Str::random(10),
                'username' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $users[] = [
            'name' => 'Admin Name',
            'username' => 'minigram',
            'email' => 'admin@minigram.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->insert($users);
    }
}
