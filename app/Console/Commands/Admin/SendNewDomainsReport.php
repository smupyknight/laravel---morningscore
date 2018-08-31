<?php

namespace App\Console\Commands\Admin;

use Carbon\Carbon;
use \stdClass;
use App\Models\Domain;
use App\Models\Competitor;
use Illuminate\Support\Facades\Mail;
use App\Mail\System\NewDomainsReport;
use Illuminate\Console\Command;

class SendNewDomainsReport extends Command
{
    protected $signature = 'admin:new-domains-report';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
		$after = Carbon::now()->subHours(12);

		//$latest = BaseDomain::select('domain')->where('created_at', '>', $after)->distinct()->get()->pluck('domain')->all();
		//$dupes	= BaseDomain::select('domain')->where('created_at', '<', $after)->distinct()->whereIn('domain', $latest)->get()->pluck('domain')->all();

		//$new = array_diff($latest, $dupes);

		$domains = Domain::where('created_at', '>', $after)->with('locales')->get();
		$comps = Competitor::where('created_at', '>', $after)->with('competitor.locales')->get();

		$report = $domains
			->concat($comps)
			->map(function ($domain) {

				$obj = new stdClass();
				$obj->domain = $domain->domain;

				if ($domain instanceof Domain) {
					$obj->locale = $domain->locales()->first()->display;

				} else if ($domain instanceof Competitor) {
					$obj->locale = $domain->competitor->locales()->first()->display;

				} else {
					$obj->locale = 'N/A';
				}

				return $obj;

			})->unique();

		Mail::to('mail@morningscore.io')->send(new NewDomainsReport($report));
    }
}
