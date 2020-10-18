<?php

namespace App\Providers;

use App\Crawlers\Clients\CrawlerClient;
use App\Crawlers\Configuration;
use App\Crawlers\Contracts\CrawlerClientInterface;
use App\Crawlers\Contracts\SelectorInterface;
use App\Contracts\StorageInterface;
use App\Services\StorageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CrawlerClientInterface::class, CrawlerClient::class);
        $this->app->singleton(SelectorInterface::class, Configuration::class);
        $this->app->singleton(StorageInterface::class, StorageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
