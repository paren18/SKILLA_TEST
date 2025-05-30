<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'User 1', 'email' => 'user1@example.com', 'password' => bcrypt('password123'), 'partnership_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User 2', 'email' => 'user2@example.com', 'password' => bcrypt('password123'), 'partnership_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User 3', 'email' => 'user3@example.com', 'password' => bcrypt('password123'), 'partnership_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
