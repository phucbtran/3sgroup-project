<?php

use Illuminate\Database\Seeder;
use App\Repositories\UsersRepository;
use App\Repositories\RolesRepository;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    protected $usersRepository;
    protected $rolesRepository;

    public function __construct(UsersRepository $usersRepository,
                                RolesRepository $rolesRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->rolesRepository = $rolesRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $roleId = $this->rolesRepository->all()->pluck('id');

        $this->usersRepository->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'full_name' => 'Tran Cong Phuc',
            'role_id' => $this->rolesRepository->findByField('name', 'admin')->first()->id,
            'status' => '0'
        ]);

        for ($i = 0; $i < 9; $i++) {
            $this->usersRepository->create([
                'email' => $faker->email,
                'password' => bcrypt('12345678'),
                'full_name' => $faker->name,
                'role_id' => $roleId[rand(0, count($roleId) - 1)],
                'status' => '0'
            ]);
        }
    }
}
