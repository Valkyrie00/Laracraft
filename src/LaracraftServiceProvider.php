<?php

namespace Valkyrie\Laracraft;

use Illuminate\Support\ServiceProvider;

class LaracraftServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        include __DIR__.'/routes.php';

        $this->publishes([
            __DIR__.'/Database/migrations' => base_path('database/migrations'),
        ]);

        $this->publishes([
            __DIR__.'/Resources/Views' => base_path('resources/views/laracraft'),
        ]);

        $this->publishes([
            __DIR__.'/Public' => base_path('public/laracraft'),
        ]);

        $this->publishes([
            __DIR__.'/Node/laracraft.js' => base_path('laracraft.js'),
        ]);

        $this->publishes([
            __DIR__.'/Node/composer.phar' => base_path('composer.phar'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Valkyrie\Laracraft\Controllers\DashboardController');
        $this->app->make('Valkyrie\Laracraft\Controllers\BackupController');
        $this->app->make('Valkyrie\Laracraft\Controllers\ComposerController');
        $this->app->make('Valkyrie\Laracraft\Controllers\CreativeController');
        $this->app->make('Valkyrie\Laracraft\Controllers\PackageController');
        $this->app->make('Valkyrie\Laracraft\Controllers\RouteController');
        $this->app->make('Valkyrie\Laracraft\Controllers\ConfigController');

        $this->app->make('Valkyrie\Laracraft\Controllers\Base\ControllerController');
        $this->app->make('Valkyrie\Laracraft\Controllers\Base\ModelController');
        $this->app->make('Valkyrie\Laracraft\Controllers\Base\MigrationController');
        $this->app->make('Valkyrie\Laracraft\Controllers\Base\RouteController');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laracraft'];
    }
}