<?php

namespace App\Console\Commands\Sync;

use Illuminate\Console\Command;
use App\Models\Domain;

class TrackKeywords extends Command
{
    protected $signature = 'sync:track-keywords';
    protected $description = 'Track active, unsynced keywords';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
		$domains = Domain::whereHas('activeKeywords', function ($q) {
			$q->notSynced();
		})->with(['activeKeywords' => function ($q) {
			$q->notSynced();
		}])->take(5)->get();

		foreach ($domains as $domain) {
			if (! empty($domain->activeKeywords)) {
				$this->info('Tracking keywords for domain ' . $domain->domain);
				$domain->trackKeywords($domain->activeKeywords);
			}
		}
    }
}
