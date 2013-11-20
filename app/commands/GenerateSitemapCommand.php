<?php
namespace Command;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateSitemapCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a JSON sitemap into app/metadata.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // Here it should do actual stuff eventually
        $this->line('Welcome to the sitemap generator.');
        $array = [];

        $uploadPath = \Data::path().'/sitemap.json';
        try {
            $sitemap = \Site::sitemap();

            $urls = $sitemap->getElementsByTagName('loc');
            foreach ($urls as $url) {
                $array[] = $url->nodeValue;
            }
            \Data::create('sitemap', $array, '');

            $this->info('Written sitemap to '.$uploadPath);
        } catch (\Exception $e) {
            throw $e;
        }


    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        // return array(
        //     array('example', InputArgument::REQUIRED, 'An example argument.'),
        // );
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        // return array(
        //     array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        // );
        return [];
    }
}
