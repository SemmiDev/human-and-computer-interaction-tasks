<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Sammi Aldhi Yanto',
            'username' => 'sammidev',
            'password' => bcrypt('12345678'),
            'email' => 'Sammi@gmail.com'
        ]);
    }
}
