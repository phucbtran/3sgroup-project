<?php

use Illuminate\Database\Seeder;
use App\Repositories\UsersRepository;
use App\Repositories\RolesRepository;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    protected $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $this->usersRepository->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'full_name' => 'Tran Cong Phuc',
            'role' => '0',
            'status' => '0'
        ]);

        for ($i = 0; $i < 9; $i++) {
            $this->usersRepository->create([
                'email' => $faker->email,
                'password' => bcrypt('12345678'),
                'full_name' => $faker->name,
                'role' => rand(0, 1),
                'status' => '0'
            ]);
        }
    }
}
