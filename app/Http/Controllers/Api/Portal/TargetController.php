<?php

namespace App\Http\Controllers\Api\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Locale;

class TargetController extends Controller
{
	public function select(Request $request)
	{
		$request->validate([
			'domain_id' => 'required|int|exists:domains,id',
		]);

        $domain = Domain::where('id', $request->domain_id)->first();

        if ($domain === null) {
            return abort(404);
        }
        
        $this->authorize('view', $domain);
		return $domain->env_data;
	}
}
