<?php
// User Authenthication required
Route::middleware(['auth'])->group(function () {
    
    Route::group(['middleware' => 'domain_check'], function () {
        Route::group(['middleware' => 'context:envdata'], function () {
            Route::name('portal.home')->get('', 'HomeController@show');
        });
    });
    
	Route::group(['middleware' => 'context:setup'], function () {
		Route::name('portal.setup')->get('setup', 'SetupController@show');
	});
    Route::name('portal.setup.do')->post('setup', 'SetupController@setup');
    
    Route::name('portal.google.connect')->any('google/connect/{domain?}', 'GoogleController@connectWithOauth');
});

// Authenthication NOT required
Route::name('portal.social')->get('social/{service}', 'SocialiteController@redirectToProvider');
Route::name('portal.social.callback')->get('social/{service}/callback', 'SocialiteController@handleProviderCallback');


Route::get('test', 'HomeController@show');
Route::get('payment-test', 'HomeController@payment');
