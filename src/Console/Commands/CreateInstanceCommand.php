<?php namespace Lokielse\Console\Console\Commands;

use File;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateInstanceCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'console:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a console instance.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $name      = $this->argument('name');
        $force     = $this->option('force');
        $namespace = trim(config('console.namespace'));

        if ( ! $namespace) {
            $this->error("The config 'namespace' in 'config/console.php' can not be empty, general set it to 'admin'");
            exit;
        }

        if ( ! $name) {
            $this->error('The name can not be empty');
            exit;
        }

        if ( ! config("console.instances.{$name}")) {
            $this->warn("The config of instance '{$name}' is not exist, check the typo or add it to config/console.php first");
            exit;
        }

        $name = strtolower($name);

        //dd($name);

        $destCoffee   = base_path("resources/assets/coffee/{$namespace}/{$name}");
        $destSass     = base_path("resources/assets/sass/{$namespace}/{$name}");
        $destTemplate = base_path("resources/assets/templates/{$namespace}/{$name}");
        $destIndex    = base_path("resources/views/{$namespace}/{$name}");

        foreach ([ $destCoffee, $destTemplate, $destSass, $destIndex ] as $dir) {
            if (is_dir($dir)) {
                if ( ! $force) {
                    $this->error("The directory $dir is already exists, use -f 1 options to overwrite it");
                    exit;
                }
            } else {
                File::makeDirectory($dir, 0755, true, true);
            }
        }

        $this->info("Copying files to " . str_replace(base_path() . '/', '', $destCoffee));
        File::copyDirectory(realpath(__DIR__ . '/../../../resources/assets/coffee/_namespace_/_name_'), $destCoffee);

        $this->info("Copying files to " . str_replace(base_path() . '/', '', $destSass));
        File::copyDirectory(realpath(__DIR__ . '/../../../resources/assets/sass/_namespace_/_name_'), $destSass);

        $this->info("Copying files to " . str_replace(base_path() . '/', '', $destTemplate));
        File::copyDirectory(realpath(__DIR__ . '/../../../resources/assets/templates/_namespace_/_name_'), $destTemplate);

        $this->info("Copying files to " . str_replace(base_path() . '/', '', $destIndex));
        File::copyDirectory(realpath(__DIR__ . '/../../../resources/views/_namespace_/_name_'), $destIndex);

        $this->warn("Done! run 'gulp default && gulp watch' to generate assets");
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            [ 'name', InputArgument::REQUIRED, 'The app name.' ],
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
            [ 'dir', 'd', InputOption::VALUE_OPTIONAL, 'The root directory of templates' ],
            [ 'force', 'f', InputOption::VALUE_OPTIONAL, 'Overwrite the exist files' ]
        ];
    }

}
