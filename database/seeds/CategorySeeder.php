<?php

use Illuminate\Database\Seeder;
use App\Repositories\CategoriesRepository;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    protected $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    private $data = [
        '0' => [
            'name' => '3S Edu',
            'level' => 1,
            'group_id' => 1,
            'slug' => '3s-edu',
            'cat_parent_id' => null,
            'num_sort' => '1',
            'status' => '0'
        ],
        '1' => [
            'name' => 'Store',
            'level' => 1,
            'group_id' => 2,
            'slug' => 'store',
            'cat_parent_id' => null,
            'num_sort' => '2',
            'status' => '0'
        ],
        '2' => [
            'name' => 'Investment',
            'level' => 1,
            'group_id' => 3,
            'slug' => 'investment',
            'cat_parent_id' => null,
            'num_sort' => '3',
            'status' => '0'
        ],
        '3' => [
            'name' => 'Commerce',
            'level' => 1,
            'group_id' => 4,
            'slug' => 'commerce',
            'cat_parent_id' => null,
            'num_sort' => '4',
            'status' => '0'
        ],
        '4' => [
            'name' => 'Real Property',
            'level' => 1,
            'group_id' => 5,
            'slug' => 'real-property',
            'cat_parent_id' => null,
            'num_sort' => '5',
            'status' => '0'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        if(!$this->categoriesRepository->first()) {
            foreach ($this->data as $item) {
                $this->categoriesRepository->create($item);
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $name = $faker->name;
            $this->categoriesRepository->create([
                'level' => 2,
                'group_id' => 1,
                'name' => $name,
                'slug' => Str::slug($name, '-'),
                'cat_parent_id' => 1,
                'num_sort' => $i,
                'status' => 0,
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            $name = $faker->name;
            $this->categoriesRepository->create([
                'level' => 3,
                'group_id' => 1,
                'name' => $name,
                'slug' => Str::slug($name, '-'),
                'cat_parent_id' => 6,
                'num_sort' => $i,
                'status' => 0,
            ]);
        }
    }
}
