<?php

use Illuminate\Database\Seeder;
use App\Repositories\CategoriesRepository;

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
            'slug' => '3s-edu',
            'img_dir_path' => '/public/img/cat/1.png',
            'cat_parent_id' => null,
            'num_sort' => '1',
            'status' => '0'
        ],
        '1' => [
            'name' => 'Store',
            'slug' => 'store',
            'img_dir_path' => '/public/img/cat/2.png',
            'cat_parent_id' => null,
            'num_sort' => '2',
            'status' => '0'
        ],
        '2' => [
            'name' => 'Investment',
            'slug' => 'investment',
            'img_dir_path' => '/public/img/cat/3.png',
            'cat_parent_id' => null,
            'num_sort' => '3',
            'status' => '0'
        ],
        '3' => [
            'name' => 'Commerce',
            'slug' => 'commerce',
            'img_dir_path' => '/public/img/cat/4.png',
            'cat_parent_id' => null,
            'num_sort' => '4',
            'status' => '0'
        ],
        '4' => [
            'name' => 'Real Property',
            'slug' => 'real-property',
            'img_dir_path' => '/public/img/cat/5.png',
            'cat_parent_id' => null,
            'num_sort' => '5',
            'status' => '0'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!$this->categoriesRepository->first()) {
            foreach ($this->data as $item) {
                $this->categoriesRepository->create($item);
            }
        }
    }
}
