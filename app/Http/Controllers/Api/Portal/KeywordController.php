<?php

namespace App\Http\Controllers\Api\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DomainKeyword;
use App\Models\Domain;
use App\Models\Locale;
use Illuminate\Support\Facades\Auth;
use App\Support\Validation\UserHasDomainValidation;
use Morningscore;
use Illuminate\Support\Facades\App;

class KeywordController extends Controller
{
    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'keywords' => 'required_without:keyword|string',
            'keyword' => 'required_without:keywords|string|max:255',
            'domain_id' => ['required', 'int', new UserHasDomainValidation()],
        ]);

        $domain = Domain::where('id', '=', $request->input('domain_id'))->first();
        if ($domain === null) {
            return abort(404);
        }
		return $domain;
    }

    public function create(Request $request)
    {
		$domain = $this->validateRequest($request);

		$keywords = DomainKeyword::processInput($request->get('keywords'));
		$keywords = $domain->filterKeywords($keywords);

		$company	= $domain->companies()->first();
		$available	= $company->available_kws_count;

		if(count($keywords) > $available) {
			$error = [
				'message'	=> 'To many keywords',
			];

			if($available <= 0) {
				$error['errors'] = [
					'keywords' => ["You don't have any keywords left."],
				];
			} else {
				$error['errors'] = [
					'keywords' => ["You only have {$available} available keywords."],
				];
			}

			return response($error, 422);
		}

		$domain->addKeywords($keywords);

		return $domain->activeKeywords()->pluck('keyword');
    }
    
    public function delete(Request $request)
    {
        $domain = $this->validateRequest($request);
		$keyword = $request->get('keyword');
		$kw = $domain->activeKeywords()->where('keyword', $keyword)->first();

		if ($kw === null) {
			return abort(404);
		}

        $kw->update(['active' => false]);
        
        if (!$kw->activeLikeThis() && App::environment('production')) {
            $removed = Morningscore::untrackKeyword($kw);
			if ($removed) {
				$kw->delete();
			}
        }

		return $domain->activeKeywords()->pluck('keyword');
    }
}
