<?php

namespace tyler36\HelperMacros;

use Illuminate\Support\ServiceProvider;

class HelperMacrosServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Nothing
    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // HELPERS
        require_once(__DIR__ . '/Helper/Helper.php');

        // MACROS
        require_once(__DIR__ . '/Macros/CollectionMacroServiceProvider.php');
        $this->app->register('tyler36\HelperMacros\CollectionMacroServiceProvider');

        require_once(__DIR__ . '/Macros/ResponseMacroServiceProvider.php');
        $this->app->register('tyler36\HelperMacros\ResponseMacroServiceProvider');
    }
}
