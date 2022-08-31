<?php

namespace App\Providers;

use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TeacherRepositoryInterface::class, function ($app) {
            return new TeacherRepository();
        });
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
