<?php

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
        DB::table('users')->insert([
            'name' => 'test.buyer',
            'email' => 'test-buyer-one@gmail.com',
            'password' => bcrypt('secret'),
            'balance' => 0
        ]);
    }
}
