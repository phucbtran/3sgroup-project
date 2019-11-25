<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\RolesRepository::class, \App\Repositories\RolesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UsersRepository::class, \App\Repositories\UsersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ContactsRepository::class, \App\Repositories\ContactsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CategoriesRepository::class, \App\Repositories\CategoriesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductsRepository::class, \App\Repositories\ProductsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\NewsRepository::class, \App\Repositories\NewsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CooperationsRepository::class, \App\Repositories\CooperationsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CommentsRepository::class, \App\Repositories\CommentsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ImgActivitiesRepository::class, \App\Repositories\ImgActivitiesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SlidesRepository::class, \App\Repositories\SlidesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CompanyRepository::class, \App\Repositories\CompanyRepositoryEloquent::class);
        //:end-bindings:
    }
}
