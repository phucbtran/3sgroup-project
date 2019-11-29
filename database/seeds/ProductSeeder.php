<?php

use Illuminate\Database\Seeder;
use App\Repositories\ProductsRepository;

class ProductSeeder extends Seeder
{
    protected $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    private $data = [
        '0' => [
            'name' => 'Kỹ năng cơ bản',
            'slug' => 'ky-nang-co-ban',
            'category_id' => 1,
            'img_dir_path' => '/public/img/prod/1.png',
            'meta_title' => 'Kỹ năng cơ bản',
            'content' => 'abc',
            'num_sort' => '1',
            'status' => '0'
        ],
        '1' => [
            'name' => 'Kỹ năng nâng cao',
            'slug' => 'ky-nang-nang-cao',
            'category_id' => 1,
            'img_dir_path' => '/public/img/prod/2.png',
            'meta_title' => 'Kỹ năng nâng cao',
            'content' => 'abc',
            'num_sort' => '2',
            'status' => '0'
        ],
        '2' => [
            'name' => 'Quản lý và lãnh đạo',
            'slug' => 'quan-ly-va-lanh-dao',
            'category_id' => 1,
            'img_dir_path' => '/public/img/prod/3.png',
            'meta_title' => 'Quản lý và lãnh đạo',
            'content' => 'abc',
            'num_sort' => '3',
            'status' => '0'
        ],
        '3' => [
            'name' => 'Đặc huấn thành công',
            'slug' => 'dac-huan-thanh-cong',
            'category_id' => 1,
            'img_dir_path' => '/public/img/prod/4.png',
            'meta_title' => 'Đặc huấn thành công',
            'content' => 'abc',
            'num_sort' => '4',
            'status' => '0'
        ],
        '4' => [
            'name' => 'Trầm hương',
            'slug' => 'tram-huong',
            'category_id' => 2,
            'img_dir_path' => '/public/img/prod/5.png',
            'meta_title' => 'Trầm hương',
            'content' => 'abc',
            'num_sort' => '5',
            'status' => '0'
        ],
        '5' => [
            'name' => 'Đá quý',
            'slug' => 'da-quy',
            'category_id' => 2,
            'img_dir_path' => '/public/img/prod/6.png',
            'meta_title' => 'Đá quý',
            'content' => 'abc',
            'num_sort' => '6',
            'status' => '0'
        ],
        '6' => [
            'name' => 'Mỹ phẩm',
            'slug' => 'my-pham',
            'category_id' => 2,
            'img_dir_path' => '/public/img/prod/7.png',
            'meta_title' => 'Mỹ phẩm',
            'content' => 'abc',
            'num_sort' => '7',
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
        if(!$this->productsRepository->first()) {
            foreach ($this->data as $item) {
                $this->productsRepository->create($item);
            }
        }
    }
}
