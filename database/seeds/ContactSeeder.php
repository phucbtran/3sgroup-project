<?php

use Illuminate\Database\Seeder;
use App\Repositories\ContactsRepository;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    protected $contactsRepository;

    public function __construct(ContactsRepository $contactsRepository)
    {
        $this->contactsRepository = $contactsRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $this->contactsRepository->create([
                'full_name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'title' => $faker->name,
                'content' => $faker->paragraph,
            ]);
        }
    }
}
