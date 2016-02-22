<?php

namespace Longkyanh\Mailer;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

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
        $config = $this->app['config']->get('optivo');

        $this->app->bind('Longkyanh\Mailer\Optivo', function ($app) {

            return new Optivo($config);
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
