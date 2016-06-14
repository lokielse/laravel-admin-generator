<?php namespace Lokielse\AdminGenerator\Console\Commands;

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
    protected $name = 'admin:entity:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an entity.';


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
        $namespace = config('admin-generator.namespace');
        $engine    = config("admin-generator.instances.{$instance}.engine");

        if ( ! $namespace) {
            $this->error("The config 'namespace' in 'config/admin-generator.php' can not be empty, general set it to 'console'");
            exit;
        }

        if ( ! config("admin-generator.instances.{$instance}")) {
            $this->warn("The instance '{$instance}' is not exist, check the typo or add it to config/admin-generator.php first");
            exit;
        }

        if ( ! $engine) {
            $this->warn("The engine of instance '{$instance}' is not exist, check the typo or add it to config/admin-generator.php first");
        }

        $templates = $this->getTemplates($template, $merge, $engine);

        $files = $this->getMergedFiles($templates, $engine);

        $filesystem = new Filesystem();

        foreach ($files as $src) {
            $destName = $this->getFileDest($src, $engine);

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

        foreach ($templates as $n => $template) {
            $path = $this->getTemplateDir($template, $engine);

            $finder = new Finder();

            foreach ($finder->in($path) as $file) {
                /**
                 * @var \SplFileInfo $file
                 */
                if ($file->isFile()) {
                    $add = true;

                    for ($k = $n + 1; $k < count($templates); $k++) {
                        if ($this->fileExistInTemplate($path, $file, $engine, $templates[$k])) {
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


    protected function fileExistInTemplate($path, \SplFileInfo $file, $engine, $template)
    {
        $uri = str_replace($path, '',$file->getRealPath());
        $base = $this->getTemplateDir($template, $engine);

        $filename = $base.$uri;

        return is_file($filename);
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
            [ 'entity', InputArgument::REQUIRED, 'The entity name.' ],
            [ 'instance', InputArgument::REQUIRED, 'The instance name.' ],
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
        $namespace = camel_case(config('admin-generator.namespace'));
        $instance  = camel_case($this->argument('instance'));
        $entity    = camel_case($this->argument('entity'));

        $replaced = preg_replace([
            '#_theNamespace_#',
            '#_theNamespaces_#',
            '#_the-namespace_#',
            '#_the_namespace_#',
            '#_the-namespaces_#',
            '#_the_namespaces_#',
            '#_TheNamespace_#',
            '#_TheNamespaces_#',
            /**/
            '#_theInstance_#',
            '#_theInstances_#',
            '#_the-instance_#',
            '#_the_instance_#',
            '#_the-instances_#',
            '#_the_instances_#',
            '#_TheInstance_#',
            '#_TheInstances_#',
            /**/
            '#_theEntity_#',
            '#_theEntities_#',
            '#_the-entity_#',
            '#_the_entity_#',
            '#_the-entities_#',
            '#_the_entities_#',
            '#_TheEntity_#',
            '#_TheEntities_#',
        ], [
            camel_case($namespace),
            camel_case(str_plural($namespace)),
            snake_case($namespace, '-'),
            snake_case($namespace, '_'),
            snake_case(str_plural($namespace), '-'),
            snake_case(str_plural($namespace), '_'),
            ucfirst(camel_case($namespace)),
            ucfirst(camel_case(str_plural($namespace))),
            /**/
            camel_case($instance),
            camel_case(str_plural($instance)),
            snake_case($instance, '-'),
            snake_case($instance, '_'),
            snake_case(str_plural($instance), '-'),
            snake_case(str_plural($instance), '_'),
            ucfirst(camel_case($instance)),
            ucfirst(camel_case(str_plural($instance))),
            /**/
            camel_case($entity),
            camel_case(str_plural($entity)),
            snake_case($entity, '-'),
            snake_case($entity, '_'),
            snake_case(str_plural($entity), '-'),
            snake_case(str_plural($entity), '_'),
            ucfirst(camel_case($entity)),
            ucfirst(camel_case(str_plural($entity))),
        ], $content);

        return $replaced;
    }


    /**
     * @return mixed|string
     */
    protected function getTemplatePath($engine)
    {
        $templatePath = config('admin-generator.templates_path', base_path('resources/admin-templates'));
        $templatePath = rtrim($templatePath, '/') . '/' . $engine;

        return $templatePath;
    }


    /**
     * @param $template
     * @param $merge
     *
     * @return array
     *
     * @internal param $engine
     *
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
