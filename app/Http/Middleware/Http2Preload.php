<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Http2Preload
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		/*
		 * 1) Process the request
		 */
		$response = $next($request);

		/*
		 * Should we not do this?
		 */

		if ($response->isRedirection() || !$response instanceof Response || $request->isJson()) {
			return $response;
		}

		/*
		 * We now have the "final" response. Let us build the list of assets
		 */

		$assets = [];

		$content = $response->content();

		$assetTypes = config('app.h2_preload_types', []);

		$regexes = [
			'script' => '<script.*src="(?P<script>.*)"',
			'style' => '<link.*stylesheet.*href="(?P<style>.*)".*>',
			'image' => '<img.*src="(?P<image>http.*)"',
		];

		foreach($regexes as $key => $val)
		{
			if(!in_array($key, $assetTypes))
			{
				unset($regexes[$key]);
			}
		}

		if(!empty($regexes))
		{

			$regex = '/' . implode('|', $regexes) . '/iU';

			$regexMatches = [];
			preg_match_all($regex, $content, $regexMatches);

			foreach ($assetTypes as $type)
			{
				if (isset($regexMatches[$type]))
				{
					$matches = $regexMatches[$type];
					if (is_array($matches) && !empty($matches))
					{
						/*
						 * Remove any empty values
						 */
						$matches = array_filter($matches);

						/*
						 * Build the header part for this type
						 */
						//$assets[] = '<' . implode(',', $matches) . '>; rel=preload; as=' . $type;

						foreach($matches as $match)
						{
							$assets[] = '<' . $match . '>; rel=preload; as=' . $type;
						}

					}
				}
			}
		}

		/*
		 * Add preload header for HTTP2
		 */

		if(!empty($assets))
		{
			$response->header('Link', implode(', ', $assets), false);
		}

		return $response;
	}
}