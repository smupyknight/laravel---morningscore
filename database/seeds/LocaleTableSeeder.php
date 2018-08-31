<?php

use App\Models\Locale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class LocaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = json_decode(Storage::get('google_localizations.json'));
		$existing = Locale::get()->keyBy('hl_gl');

        foreach ($locales as $locale) {

            $hl		= explode('-', $locale->localization)[0];
			$hlGl	= "{$hl}_{$locale->country_iso_code}";

			$new = $existing->get($hlGl);

			if ($new === null) {
				$new = new Locale();

			} else {
				$existing->forget($hlGl);
			}

            $new->gl			= $locale->country_iso_code;
            $new->hl			= $hl;
            $new->country		= $locale->country;
            $new->language		= $locale->language;
            $new->search_engine	= $locale->search_engine;

			if (isset($locale->primary)) {
				$new->is_primary = $locale->primary;
			}

			if ($new->isDirty()) {
				$new->save();
			}
        }

		if ($existing->isNotEmpty()) {
			foreach ($existing as $locale) {
				$locale->delete();
			}
		}
    }
}
