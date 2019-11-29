<?php

use Illuminate\Database\Seeder;
use App\Repositories\CommentsRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\CooperationsRepository;
use App\Repositories\NewsRepository;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    protected $commentsRepository;
    protected $productsRepository;
    protected $cooperationsRepository;
    protected $newsRepository;

    public function __construct(CommentsRepository $commentsRepository,
                                ProductsRepository $productsRepository,
                                CooperationsRepository $cooperationsRepository,
                                NewsRepository $newsRepository)
    {
        $this->commentsRepository = $commentsRepository;
        $this->productsRepository = $productsRepository;
        $this->cooperationsRepository = $cooperationsRepository;
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
        $productId = $this->productsRepository->all()->pluck('id');
        $cooperationId = $this->cooperationsRepository->all()->pluck('id');
        $newId = $this->newsRepository->all()->pluck('id');

        for ($i = 0; $i < 30; $i++) {
            if ($i < 10) {
                $postId = $productId[rand(0, count($productId) - 1)];
                $typeCmtFlg = '0';
            } else if ($i >= 10 && $i < 20) {
                $postId = $newId[rand(0, count($newId) - 1)];
                $typeCmtFlg = '1';
            } else {
                $postId = $cooperationId[rand(0, count($cooperationId) - 1)];
                $typeCmtFlg = '2';
            }

            $this->commentsRepository->create([
                'full_name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'post_id' => $postId,
                'type_cmt_flg' => $typeCmtFlg,
                'content' => $faker->paragraph,
                'status' => '0'
            ]);
        }
    }
}
