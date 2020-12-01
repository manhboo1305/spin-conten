<?php

namespace  ManhND\TextSpinner;

use Illuminate\Support\ServiceProvider;

class  SpinServiceProvider extends  ServiceProvider{
    protected  $defer = true;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SpinText::class);
        include __DIR__.'/routes/web.php';
        if ($this->app->runningInConsole()) {
            $this->loadViewsFrom(__DIR__.'/views', 'spin');
            $this->commands([
                ViewCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Allow your user to publish the config
        $this->publishes([
            __DIR__.'/Config/spin-config.php' => config_path('spin-config.php'),
        ], 'config');

        $this->publishes([__DIR__.'/../database/migrations/' => database_path('migrations')], 'migrations');
    }
    public function provides()
    {
        return [
            ViewCommand::class,
        ];
    }
}
