<?php

use Illuminate\Database\Seeder;
use App\Repositories\NewsRepository;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
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
            $this->newsRepository->create([
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
