<?php

namespace App\Providers;

use App\RepositoryInterface\UserRepositoryInterface;
use App\Repository\DBUsersRepository;
use App\RepositoryInterface\ShortenLinkRepositoryInterface;
use App\Repository\DBShortenLinksRepository;
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
        $this->app->bind(UserRepositoryInterface::class,DBUsersRepository::class);
        $this->app->bind(ShortenLinkRepositoryInterface::class,DBShortenLinksRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
