<?php

namespace damisadam\BfmrApiClient;

use Illuminate\Support\ServiceProvider;

class BfmrApiClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/bfmr.php', 'bfmr');
        $this->app->singleton('bfmr-api', function () {
            return new BfmrApi();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/bfmr.php' => config_path('bfmr.php'),
        ]);
    }
}