<?php

namespace Longkyanh\Mailer;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use GuzzleHttp\Client as GuzzleHttpClient;

/**
 * @author Long Nguyen <nguyentienlong88@gmail.com>
 */
class OptivoServiceProvider extends IlluminateServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     *
     */
    protected $defer =  true;

    /**
    * Register bindings in the container.
    *
    * @return void
    */
    public function register()
    {
        $this->$app->singleton('optivo-mailer', function($app) {
            $config = isset($app['config']['optivo'])? $app['config']['optivo'] : null;
            if (is_null($config)) {
                $config = $app['config']['optivo::config'];
            }
            $guzzleClient =  new GuzzleHttpClient();
            $optivoMailer = new Optivo($guzzleClient, $config);

            return $optivoMailer;
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
