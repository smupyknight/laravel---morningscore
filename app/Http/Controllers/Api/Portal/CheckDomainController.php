<?php

namespace App\Http\Controllers\Api\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\Validation\CheckDomainValidation;

class CheckDomainController extends Controller
{
	public function check(Request $request)
	{
        $request->validate([
			'domain' => [
				'required',
				'string',
				'min:3',
				new CheckDomainValidation(),
			]
		]);
		return;
	}
}
    
