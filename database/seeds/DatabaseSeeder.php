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
            'account' => '0x0b5e6646f3665e5132fddaabf1af95386e70148f',
            'password' => bcrypt('secret'),
            'balance' => 0
        ]);
    }
}
