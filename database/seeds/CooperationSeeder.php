<?php

use Illuminate\Database\Seeder;
use App\Repositories\CooperationsRepository;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CooperationSeeder extends Seeder
{
    protected $cooperationsRepository;

    public function __construct(CooperationsRepository $cooperationsRepository)
    {
        $this->cooperationsRepository = $cooperationsRepository;
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
            $titleName = $faker->name;
            $this->cooperationsRepository->create([
                'title_name' => $titleName,
                'slug' => Str::slug($titleName, '-'),
                'img_dir_path' => $faker->imageUrl(),
                'meta_title' => $titleName,
                'content' => $faker->paragraph,
                'num_sort' => $faker->numberBetween(0, 100),
                'status' => '0',
            ]);
        }
    }
}
