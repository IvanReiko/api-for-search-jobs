<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\CompanyInterface;
use App\Repositories\Contracts\JobInterface;
use App\Repositories\Web\JobRepository;
use App\Repositories\Web\CompanyRepository;
use App\Models\Country;
use App\Models\City;
use App\Models\Industry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        $this->app->singleton(CompanyInterface::class, CompanyRepository::class);
        $this->app->singleton(JobInterface::class, JobRepository::class);

    }
}
