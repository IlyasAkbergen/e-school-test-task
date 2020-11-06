<?php

namespace App\Providers;

use App\Services\v1\Marks\MarksService;
use App\Services\v1\Marks\MarksServiceImpl;
use Illuminate\Support\ServiceProvider;

class SystemServiceProvider extends ServiceProvider
{
    /**e
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            MarksService::class,
            MarksServiceImpl::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
