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
            'name' => 'Test Buyer',
            'email' => 'test-buyer-one@gmail.com',
            'account' => '0x0b5e6646f3665e5132fddaabf1af95386e70148f',
            'routing' => '108800',
            'account_no' => '00012345',
            'password' => bcrypt('secret'),
            'balance' => 0
        ]);
    }
}
