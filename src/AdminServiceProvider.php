<?php namespace Lokielse\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([ realpath(__DIR__ . '/../config/config.php') => config_path('admin.php') ]);
    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('admin.command.instance.new', function ($app) {
            return $app->make('Lokielse\Admin\Console\Commands\CreateInstanceCommand');
        });

        $this->app->bindShared('admin.command.entity.new', function ($app) {
            return $app->make('Lokielse\Admin\Console\Commands\CreateEntityCommand');
        });

        $this->commands('admin.command.instance.new');
        $this->commands('admin.command.entity.new');
    }
}