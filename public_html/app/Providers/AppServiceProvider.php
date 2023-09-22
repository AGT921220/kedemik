<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    // public $bindings = [
    //     ClientProfileRepository::class => ClientProfileEloquentRepository::class,
    //     ClientProfileGeneralRepository::class => ClientProfileGeneralEloquentRepository::class,
    //     ClientProfileRegimenRepository::class => ClientProfileRegimenEloquentRepository::class,
    //     GeneralProfileRepository::class => GeneralProfileEloquentRepository::class,
    //     ClientProfileFisicRepository::class => ClientProfileFisicEloquentRepository::class,
    //     ClientProfileQuimicaRepository::class => ClientProfileQuimicaEloquentRepository::class,
    //     ClientProfileComposicionRepository::class => ClientProfileComposicionEloquentRepository::class,
    //     ClientProfileTransportRepository::class => ClientProfileTransportEloquentRepository::class,
    //     ClientProfileDestinationRepository::class => ClientProfileDestinationEloquentRepository::class

    // ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
