<?php namespace Lokielse\Console\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;

class CreateEntityCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'console:entity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate entity for console.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $instance  = $this->argument('instance');
        $template  = $this->option('template');
        $force     = $this->option('force');
        $merge     = $this->option('merge');
        $namespace = config('console.namespace');
        $engine    = config("console.instances.{$instance}.engine");

        if ( ! $namespace) {
            $this->error("The config 'namespace' in 'config/console.php' can not be empty, general set it to 'console'");
            exit;
        }

        if ( ! config("console.instances.{$instance}")) {
            $this->warn("The instance '{$instance}' is not exist, check the typo or add it to config/console.php first");
            exit;
        }

        if ( ! $engine) {
            $this->warn("The engine of instance '{$instance}' is not exist, check the typo or add it to config/console.php first");
        }

        $templates = $this->getTemplates($template, $merge, $engine);

        $files = $this->getMergedFiles($templates, $engine);

        $filesystem = new Filesystem();

        foreach ($files as $src) {
            $destName = $this->getFileDest($src, $engine);

            $destName = str_replace('_namespace_', snake_case($namespace, '-'), $destName);
            $destName = str_replace('_name_', snake_case($instance, '-'), $destName);

            $destName = $this->replaceKeyword($destName);

            if (is_file($destName) && ! $force) {
                $this->error(sprintf("The file %s is already exist, use option '--force' to override it", str_replace(base_path() . '/', '', $destName)));
                exit;
            } else {
                $this->info(sprintf("Copying file to %s", str_replace(base_path() . '/', '', $destName)));
            }

            $content  = $filesystem->get($src);
            $replaced = $this->replaceKeyword($content);

            $filesystem->put($destName, $replaced);
        }

        $this->warn('Done! Please config route and menu in app.coffee and MenuController.coffee');
    }


    public function getFileDest($file, $engine)
    {
        $templatePath = $this->getTemplatePath($engine);
        $path         = preg_replace("#^$templatePath/[^/]+/#", '', $file);

        return base_path("{$path}");
    }


    protected function getMergedFiles($templates, $engine)
    {
        $names  = [ ];
        $finder = new Finder();

        foreach ($templates as $n => $template) {
            $path = $this->getTemplateDir($template, $engine);

            foreach ($finder->name('*')->in($path) as $file) {
                /**
                 * @var \SplFileInfo $file
                 */
                if ($file->isFile()) {
                    $add = true;
                    for ($k = $n + 1; $k < count($templates); $k++) {
                        if ($this->fileExistInTemplate($templates[$k])) {
                            $add = false;
                            break;
                        }
                    }
                    if ($add) {
                        $names[] = $file->getPathname();
                    }
                }
            }
        }

        return $names;
    }


    protected function fileExistInTemplate($template)
    {
        return true;
    }


    protected function getTemplateDir($template, $engine)
    {
        $templatePath = $this->getTemplatePath($engine);

        return "{$templatePath}/{$template}";
    }


    public function getRelativeNameInDir($templatePath)
    {
        $finder = new Finder();
        $names  = [ ];

        foreach ($finder->name('*')->in(base_path($templatePath)) as $file) {
            /**
             * @var \SplFileInfo $file
             */
            if ($file->isFile()) {
                $names[] = str_replace(base_path($templatePath), '', $file->getPathname());
            }
        }

        return $names;
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            [ 'instance', InputArgument::REQUIRED, 'The instance name.' ],
            [ 'name', InputArgument::REQUIRED, 'The entity name.' ],
        ];
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [ 'template', 't', InputOption::VALUE_OPTIONAL, 'The template name', 'default' ],
            [ 'force', 'f', InputOption::VALUE_NONE, 'To override an exists file' ],
            [ 'merge', 'm', InputOption::VALUE_OPTIONAL, 'To merge with default template', 1 ]
        ];
    }


    protected function replaceKeyword($content)
    {
        $name  = camel_case($this->argument('name'));
        $names = str_plural($name);

        $replaced = preg_replace([
            '#_theEntity_#',
            '#_theEntities_#',
            '#_the-entity_#',
            '#_the_entity_#',
            '#_the-entities_#',
            '#_the_entities_#',
            '#_TheEntity_#',
            '#_TheEntities_#',
        ], [
            camel_case($name),
            camel_case($names),
            snake_case($name, '-'),
            snake_case($name, '_'),
            snake_case($names, '-'),
            snake_case($names, '_'),
            ucfirst(camel_case($name)),
            ucfirst(camel_case($names)),
        ], $content);

        return $replaced;
    }


    /**
     * @return mixed|string
     */
    protected function getTemplatePath($engine)
    {
        $templatePath = config('console.templates_path', base_path('resources/console-templates'));
        $templatePath = rtrim($templatePath, '/') . '/' . $engine;

        return $templatePath;
    }


    /**
     * @param $template
     * @param $merge
     * @param $engine
     *
     * @return array
     */
    protected function getTemplates($template, $merge)
    {
        $templates = explode(',', $template);

        if ($merge) {
            array_unshift($templates, 'default');
        }

        $templates = array_unique($templates);

        return $templates;
    }

}
