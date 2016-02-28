<?php

namespace Longkyanh\Mailer;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use GuzzleHttp\Client;

/**
 * @author Long Nguyen <nguyentienlong88@gmail.com>
 */
class OptivoServiceProvider extends IlluminateServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        //only need when using facade
        $this->app->singleton('optivo', function ($app) {
            return new Optivo(new Client(), $app['config']);
        });
    }

    /**
     * Get ther services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['optivo'];
    }
}
