<?php namespace Lokielse\Console;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([ realpath(__DIR__ . '/../config/config.php') => config_path('console.php') ], 'config');

        $templatePath = $this->getTemplatePath();

        $this->publishes([ realpath(__DIR__ . '/../templates') => $templatePath ], 'templates');
    }


    /**
     * @return mixed|string
     */
    protected function getTemplatePath()
    {
        $templatePath = config('console.templates_path', base_path('resources/console-templates'));
        $templatePath = rtrim($templatePath, '/');

        return $templatePath;
    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('le-console.command.instance.new', function ($app) {
            return $app->make('Lokielse\Console\Console\Commands\CreateInstanceCommand');
        });

        $this->app->bindShared('le-console.command.entity.new', function ($app) {
            return $app->make('Lokielse\Console\Console\Commands\CreateEntityCommand');
        });

        $this->commands([
            'le-console.command.instance.new',
            'le-console.command.entity.new'
        ]);
    }
}