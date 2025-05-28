<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PageBlocksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('page-blocks', function () {
            return [
                'blocks' => [
                    //
                ]
            ];
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
