<?php namespace Lokielse\Admin\Console\Commands;

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
    protected $name = 'admin:entity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate entity for admin.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $instance = $this->argument('instance');
        $template = $this->option('template');
        $src      = $this->option('src');
        $force    = $this->option('force');

        if ( ! config("admin.instances.{$instance}")) {
            $this->warn("The instance '{$instance}' is not exist, check the typo or add it to config/admin.php first");
            exit;
        }

        if ( ! $src) {
            $src = realpath(__DIR__ . '/../../../templates');
            $src = str_replace(base_path(), '', $src);
        }

        $templatePath = trim($src, '/') . '/' . $template;

        $finder     = new Finder();
        $filesystem = new Filesystem();

        if ( !is_dir(base_path($templatePath))) {
            $this->warn(sprintf("The template '%s' is not exists in path '%s'", $template, base_path($templatePath)));
            exit;
        }

        foreach ($finder->name('*')->in(base_path($templatePath)) as $file) {
            /**
             * @var \SplFileInfo $file
             */
            if ($file->isFile()) {
                $content  = $filesystem->get($file->getPathname());
                $replaced = $this->replaceKeyword($content);

                $path = str_replace(realpath(__DIR__ . '/../../../templates/' . $template), '', $file->getPath());

                $fileDest = base_path('resources/' . trim($path, '/'));
                $baseName = $file->getBasename();
                $baseName = $this->replaceKeyword($baseName);

                $destName = rtrim($fileDest, '/') . '/' . $baseName;

                $destName = str_replace('_instance_', $instance, $destName);

                if (is_file($destName) && ! $force) {
                    $this->error(sprintf("The file %s is already exist, use -f 1 to override it", str_replace(base_path() . '/', '', $destName)));
                    exit;
                } else {
                    $this->info(sprintf("Copying file to %s", str_replace(base_path() . '/', '', $destName)));
                }

                $filesystem->put($destName, $replaced);
            }
        }

        $this->warn('Done! Please config route and menu in app.coffee and MenuController.coffee');
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
            [ 'template', 't', InputOption::VALUE_OPTIONAL, 'The template name', 'empty' ],
            [ 'plural', 'p', InputOption::VALUE_OPTIONAL, 'The plural name of entity' ],
            //[ 'modal', 'm', InputOption::VALUE_OPTIONAL, 'To create a modal?' ],
            [ 'src', 's', InputOption::VALUE_OPTIONAL, 'To template src path' ],
            [ 'force', 'f', InputOption::VALUE_OPTIONAL, 'To override an exists file' ]
        ];
    }


    protected function getPlural($name)
    {
        $plural = $this->option('plural');

        if ($plural) {
            $names = $plural;
        } else {
            $names = str_plural($name);
        }

        return $names;
    }


    protected function replaceKeyword($content)
    {
        $name  = camel_case($this->argument('name'));
        $names = $this->getPlural($name);

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

}
