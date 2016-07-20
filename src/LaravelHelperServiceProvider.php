<?php

namespace Tyler36\laravelHelpers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LaravelHelperServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    public function boot()
    {

    }


    public function register()
    {
        // HELPERS
        require_once(__DIR__ . '/Helper/Helper.php');

        // MACROS
        require_once(__DIR__ . '/Macros/CollectionMacroServiceProvider.php');
        $this->app->register('Tyler36\laravelHelpers\CollectionMacroServiceProvider');

        require_once(__DIR__ . '/Macros/ResponseMacroServiceProvider.php');
        $this->app->register('Tyler36\laravelHelpers\ResponseMacroServiceProvider');
    }
}
