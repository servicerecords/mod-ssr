<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearConverted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:converted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $storageDirectory = storage_path('app/converted');
        $directory = new \DirectoryIterator($storageDirectory);

        foreach($directory as $file) {

            if($file->isFile() && (now() - $file->getATime()) < 3600 ) {
            print $file->getFilename() . PHP_EOL;
            }

            print (time() - $file->getATime()) . PHP_EOL;
        }
        return 0;
    }
}
