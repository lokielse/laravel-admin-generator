<?php namespace Lokielse\Admin\Console\Commands;

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
    protected $name = 'admin:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin instance.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $name  = $this->argument('name');
        $force = $this->option('force');

        if ( ! $name) {
            $this->error('The name can not be empty');
            exit;
        }

        if ( ! config("admin.instances.{$name}")) {
            $this->warn("The config of instance '{$name}' is not exist, check the typo or add it to config/admin.php first");
            exit;
        }

        $name = strtolower($name);

        //dd($name);

        $destCoffee   = base_path("resources/assets/coffee/admin/{$name}");
        $destSass     = base_path("resources/assets/sass/admin/{$name}");
        $destTemplate = base_path("resources/assets/templates/admin/{$name}");
        $destIndex    = base_path("resources/views/admin/{$name}");

        foreach ([ $destCoffee, $destTemplate, $destSass, $destIndex ] as $dir) {
            if (is_dir($dir)) {
                if ( ! $force) {
                    $this->error("The dir $dir is already exists, use -f 1 options to overwrite it");
                    exit;
                }
            } else {
                File::makeDirectory($dir, 0755, true, true);
            }
        }

        $this->info("Copying files to ". str_replace(base_path().'/', '', $destCoffee));
        File::copyDirectory(realpath(__DIR__ . '/../../../resources/assets/coffee/admin/_name_'), $destCoffee);

        $this->info("Copying files to ". str_replace(base_path().'/', '', $destSass));
        File::copyDirectory(realpath(__DIR__ . '/../../../resources/assets/sass/admin/_name_'), $destSass);

        $this->info("Copying files to ". str_replace(base_path().'/', '', $destTemplate));
        File::copyDirectory(realpath(__DIR__ . '/../../../resources/assets/templates/admin/_name_'), $destTemplate);

        $this->info("Copying files to ". str_replace(base_path().'/', '', $destIndex));
        File::copyDirectory(realpath(__DIR__ . '/../../../resources/views/admin/_name_'), $destIndex);

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
