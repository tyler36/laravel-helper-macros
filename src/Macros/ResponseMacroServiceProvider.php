<?php

namespace Tyler36\laravelHelpers;

use Illuminate\Support\ServiceProvider;
use Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // MACRO:       'success' JSON response (200)
        Response::macro('success', function ($data) {
            return Response::json([
                'errors' => false,
                'data'   => $data,
            ]);
        });


        // MACRO:       'no content' JSON response (204)
        Response::macro('noContent', function () {
            return Response::json(null, 204);
        });


        // MACRO:       'error' JSON response
        Response::macro('error', function ($message, $status = 400) {
            return Response::json([
                'errors'  => true,
                'message' => $message,
            ], $status);
        });

    }


    public function register()
    {
        //
    }
}
