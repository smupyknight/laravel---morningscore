<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateTotalUserCount
{
    public function __construct()
    {
    }

    public function handle(UserCreated $event)
    {
		$count = User::count();

		$content = [
			'number' => $count,
		];

		try {
			Storage::put('public/count.json', json_encode($content));
		} catch (\Exception $e) {
			\Log::error("Couldn't write to file");
		}
    }
}
