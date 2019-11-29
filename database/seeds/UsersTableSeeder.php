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
        DB::table('users')->insertOrIgnore([
            'name' => 'Master Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Ntd123456'),
        ]);
        $user = factory(App\User::class,10)->create();
    }
}
