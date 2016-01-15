<?php namespace Lokielse\AdminGenerator;

use Illuminate\Support\ServiceProvider;

class AdminGeneratorServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([ realpath(__DIR__ . '/../config/admin-generator.php') => config_path('admin-generator.php') ], 'config');

        $templatePath = $this->getTemplatePath();

        $this->publishes([ realpath(__DIR__ . '/../templates') => $templatePath ], 'templates');
    }


    /**
     * @return mixed|string
     */
    protected function getTemplatePath()
    {
        $templatePath = config('admin-generator.templates_path', base_path('resources/admin-templates'));
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
        $this->app->singleton('le-admin.command.instance.new', function ($app) {
            return $app->make('Lokielse\AdminGenerator\Console\Commands\CreateInstanceCommand');
        });

        $this->app->singleton('le-admin.command.entity.new', function ($app) {
            return $app->make('Lokielse\AdminGenerator\Console\Commands\CreateEntityCommand');
        });

        $this->commands([
            'le-admin.command.instance.new',
            'le-admin.command.entity.new'
        ]);
    }
}
