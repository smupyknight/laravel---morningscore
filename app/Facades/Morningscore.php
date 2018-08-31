<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Morningscore extends Facade {
	protected static function getFacadeAccessor() {
		return 'morningscore';
	}
}