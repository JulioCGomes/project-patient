<?php

namespace App\Providers;

use App\Repositories\Address\AddressRepositoryFactory;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Patient\PatientRepositoryFactory;
use App\Repositories\Patient\PatientRepositoryInterface;
use App\Services\Address\AddressServiceFactory;
use App\Services\Address\AddressServiceInterface;
use App\Services\Patient\PatientServiceFactory;
use App\Services\Patient\PatientServiceInterface;
use App\Utils\ViaCep\ViaCepFactory;
use App\Utils\ViaCep\ViaCepInterface;
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
        $this->app->bind(
            PatientServiceInterface::class,
            function () {
                return (new PatientServiceFactory())();
            }
        );

        $this->app->bind(
            PatientRepositoryInterface::class,
            function () {
                return (new PatientRepositoryFactory())();
            }
        );

        $this->app->bind(
            AddressServiceInterface::class,
            function () {
                return (new AddressServiceFactory())();
            }
        );

        $this->app->bind(
            AddressRepositoryInterface::class,
            function () {
                return (new AddressRepositoryFactory())();
            }
        );

        $this->app->bind(
            ViaCepInterface::class,
            function () {
                return (new ViaCepFactory())();
            }
        );
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
