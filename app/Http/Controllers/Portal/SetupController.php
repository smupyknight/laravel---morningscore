<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Locale;
use MorningTrain\Foundation\Context\Context;
use App\Support\Validation\CheckDomainValidation;

class SetupController extends Controller
{
    public function show()
    {
        if (Auth::user()->fallback_domain !== null) {
			return redirect()->route('portal.home');
		}

        return Context::render('templates.setup');
    }

    public function setup(Request $request)
    {
        $this->validate($request, [
			'website' => [
				'required', 'string', 'min:3',
				new CheckDomainValidation(),
			],
			'locale_id'	=> [
				'required', 'int', 'exists:locales,id'
			],
            'domains'   => 'required|array|max:3',
			'domains.*' => [
				'nullable', 'string', 'min:3',
				new CheckDomainValidation(),
			],
        ]);
        
        $user = Auth::user();
		$locale = Locale::where('id', $request->locale_id)->first();
		if ($locale === null) {
            return abort(404);
		}

        $company = Company::setup($user, $request->input('website'), $locale);

		$comps = array_filter($request->input('domains'));

		if ( ! empty($comps)) {
			$company->domains()->first()->addCompetitors($comps);
		}

        return route('portal.home');
    }
}
