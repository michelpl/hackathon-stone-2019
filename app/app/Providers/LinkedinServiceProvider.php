<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LinkedinServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('linkedin-provider', function ($app) {
            $provider = new \League\OAuth2\Client\Provider\LinkedIn([
                'clientId'          => env('LINKEDIN_CLIENT_ID'),
                'clientSecret'      => env('LINKEDIN_CLIENT_SECRET'),
                'redirectUri'       => env('LINKEDIN_CALLBACK_URL'),
                'fields'            => ['id', 'firstName', 'lastName']
                //'fields'            => ['id', 'firstName', 'skills']
            ]);

            return $provider;
        });
    }
}
