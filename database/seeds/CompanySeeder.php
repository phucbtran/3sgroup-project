<?php

use Illuminate\Database\Seeder;
use App\Repositories\CompanyRepository;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $this->companyRepository->create([
            'logo_dir_path' => $faker->url,
            'address' => '388/24 Hà Huy Tập, Xuân Hà, Thanh Khê, Đà Nẵng',
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'skype' => $faker->url,
            'facebook' => $faker->url,
            'map_api' => $faker->url,
            'head_description' => $faker->paragraph,
            'detail_description' => $faker->paragraph,
            'img_detail_dir_path' => $faker->url,
            'time_event' => $faker->date(),
            'img_event_dir_path' => $faker->url,
            'title_event' => $faker->name,
            'vision' => $faker->paragraph,
            'mission' => $faker->paragraph,
            'core_value' => $faker->paragraph,
        ]);
    }
}
