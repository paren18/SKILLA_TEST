<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OrderTypesTableSeeder::class,
            PartnershipsTableSeeder::class,
            WorkersTableSeeder::class,
            UsersTableSeeder::class,
            WorkersExOrderTypesTableSeeder::class,
            OrdersTableSeeder::class,
            OrderWorkerTableSeeder::class,
        ]);
    }
}
