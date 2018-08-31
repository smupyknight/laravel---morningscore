<?php

namespace App\Http\Controllers\Api\Portal;

use App\Models\Domain;
use App\Models\Competitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\Validation\UserHasDomainValidation;
use App\Support\Validation\CheckDomainValidation;
use Morningscore;

class CompetitorController extends Controller
{
    public function update(Request $request, int $domain_id)
    {
        $domain = Domain::where('id', $domain_id)->first();
        if ($domain === null) {
            return abort(404);
        }
        
        $this->authorize('update', $domain);
        $request->validate([
            'domains'   => 'required|array|max:3',
			'domains.*' => [
				'nullable', 'string', 'min:3',
				new CheckDomainValidation(),
			],
        ]);
        
        // Competitors        
        $added_competitors = collect($request->get('domains', []));

        // Get real hostnames
		$hostnames = [];

        if($added_competitors->isNotEmpty()){
            foreach($added_competitors as $added_competitor){
                if (is_string($added_competitor) && strlen($added_competitor) > 0 && $added_competitor !== $domain->domain) {
                    $hostname = Morningscore::checkDomain($added_competitor);
                    if($hostname !== null && $hostname !== $domain->domain){
                        $hostnames[] = $hostname;
                    }
                }
            }
        }

        $domain->updateCompetitors($hostnames);

		return [
			'domains' => $domain->competitors()->pluck('domain'),
            'colors' => $domain->competitors->pluck('color', 'domain_safe'),
		];
    }

}
