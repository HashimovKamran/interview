<?php

namespace App\Providers;

use App\Application\Mediator\{Mediator, MediatorInterface};
use App\Application\Services\Adapters\APIAdapterInterface;
use App\Application\Services\Repositories\{CityRepositoryInterface, VehicleTypeRepositoryInterface};
use App\Infrastructure\Adapters\GoogleAPIAdapter;
use App\Persistence\Repositories\{CityRepository, VehicleTypeRepository};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MediatorInterface::class, function ($app) {
            return new Mediator($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(APIAdapterInterface::class, GoogleAPIAdapter::class);
        $this->app->bind(VehicleTypeRepositoryInterface::class, VehicleTypeRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
    }
}
