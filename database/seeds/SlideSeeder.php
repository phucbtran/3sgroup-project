<?php

use Illuminate\Database\Seeder;
use App\Repositories\SlidesRepository;
use Faker\Factory as Faker;

class SlideSeeder extends Seeder
{

    protected $slidesRepository;

    public function __construct(SlidesRepository $slidesRepository)
    {
        $this->slidesRepository = $slidesRepository;
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
            $this->slidesRepository->updateOrCreate([
                'sort_num' => $i,
                'alt_description' => $faker->name,
                'img_dir_path' => $faker->imageUrl(),
                'status' => "1",
            ]);
        }
    }
}
