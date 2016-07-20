<?php

namespace Tyler36\laravelHelpers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

/**
 * Class CollectionMacroServiceProvider
 *
 * @package App\Providers
 */
class CollectionMacroServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Pass collection to an anonymous function
         * Inspired by https://murze.be/2016/05/getting-package-statistics-packagist-redux/
         *
         * @param  callable $callback
         * @return mixed
         */
        Collection::macro('pipe', function ($callback) {
            return $callback($this);
        });


        /**
         * Dump and die current collection
         * Inspired by https://murze.be/2016/06/debugging-collections/
         *
         * @param  null
         */
        Collection::macro('dd', function () {
            dd($this);
        });


        /**
         * Run callback when collection is empty
         *
         * @param  callable $callback
         * @return \Illuminate\Support\Collection
         */
        Collection::macro('ifEmpty', function ($callback) {
            if ($this->isEmpty()) {
                $callback();
            }

            return $this;
        });


        /**
         * Run callback when collection has count
         *
         * @param  callable $callback
         * @return \Illuminate\Support\Collection
         */
        Collection::macro('ifAny', function ($callback) {
            if (!$this->isEmpty()) {
                $callback($this);
            }

            return $this;
        });

        /**
         * Run a validator over each of the items and filter those that fail.
         *
         * @param  callable|null $callback
         * @return \Illuminate\Support\Collection
         */
        Collection::macro('fails', function ($rules) {
            return $this->filter(function ($item) use ($rules) {
                return Validator::make($item, $rules)->fails();
            });
        });


        /**
         * Run a validator over each of the items and filter those that pass.
         *
         * @param  callable|null $callback
         * @return \Illuminate\Support\Collection
         */
        Collection::macro('passes', function ($rules) {
            return $this->filter(function ($item) use ($rules) {
                return Validator::make($item, $rules)->passes();
            });
        });
    }
}
