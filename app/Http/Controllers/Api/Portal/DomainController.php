<?php

namespace App\Http\Controllers\Api\Portal;

use App\Models\Domain;
use App\Models\Company;
use App\Models\Locale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Support\Validation\CheckDomainValidation;
use App\Support\Validation\UserHasCompanyValidation;
use App\Support\Validation\UserHasDomainValidation;

class DomainController extends Controller
{
	public function create(Request $request)
	{
        $request->validate([
			'domain' => [
				'required', 'string', 'min:3',
				new CheckDomainValidation(),
			],
			'company_id' => [
				'required',	'int',
				new UserHasCompanyValidation()
			],
			'locale_id'	=> [
				'required', 'int', 'exists:locales,id'
			],
        ]);

		$this->authorize('create', Domain::class);

		$comp = Company::where('id', $request->company_id)->first();
		$locale = Locale::where('id', $request->locale_id)->first();
		if ($comp === null || $locale === null) {
            return abort(404);
		}

		if ($comp->available_domains_count < 1) {
			$error = [
				'message'	=> 'To many domains',
				'errors'	=> [
					'domain'	=> ["You can have a maximum of {$comp->possible_domains_count} domains."],
				],
			];
			return response($error, 422);
		}

		$created = $comp->createDomain($request->domain, $locale);
		if (! $created) {
			$error = [
				'message'	=> 'Could not create domain',
				'errors'	=> [
					'domain' => ['You can not have multiple of the same domain'],
				],
			];
			return response($error, 422);
		}

		return $comp->getEnvDataDomains();
	}

	public function delete(Request $request)
	{
		$request->validate([
			'domain_id' => [
				'required',
				'int',
				'exists:domains,id',
				new UserHasDomainValidation()
			],
		]);

		$domain = Domain::where('id', $request->domain_id)->first();
		$user = Auth::user();
		$company = Company::hasUserAndDomain($user->id, $domain->id)->first(); // TODO: handle this better, when multi company domain ownership is developed

		if ($domain === null || $company === null) {
			return abort(404);
		}

		$this->authorize('delete', $domain);

		if ($company->domains()->count() < 2) {
			$error = [
				'message'	=> 'Last domain can not be deleted',
				'errors'	=> [
					'domain_id' => ['You can not delete the last company domain. Create another domain, before deleting this one.'],
				],
			];
			return response($error, 422);
		}

		$domain->delete();

		return $company->getEnvDataDomains();
	}
}
