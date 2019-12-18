<?php

namespace App\Providers;

use App\AvailabilityServices\AvailableServiceInterface;
use App\AvailabilityServices\Color;
use App\Traits\AvailableFilters;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use AvailableFilters;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /** Register Services */
        collect($this->filters())->each(function($service){
            $this->app->singleton(class_basename($service), function($app) use ($service){
                return new $service();
            });
        });
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
