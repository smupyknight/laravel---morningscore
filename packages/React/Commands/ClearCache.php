<?php

namespace MorningTrain\Foundation\React\Commands;

use Illuminate\Console\Command;

class ClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'react:clear-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes all cached react views';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (glob(storage_path('framework/react-views') . '/*/*.html') as $file) {
            unlink($file);
        }
    }
}
