<?php

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth:api', 'role:admin']], function() {
    
    Api::route('api.admin.subscription_templates', [], function($namespace, $controller, $id) {
        
        // Subscription Template Features
        Route::group(['prefix' => '{'.$id.'}/features'], function() use ($namespace, $controller){
            
            Route::name($namespace.'.features')->get('', $controller.'@getFeatures');

            Route::group(['prefix' => '/{feature_id}'], function() use ($namespace, $controller){

                // Route::name($namespace.'.features.view')->get('', $controller.'@getFeature');
                Route::name($namespace.'.features.attach')->post('', $controller.'@attachFeature');
                Route::name($namespace.'.features.detach')->delete('', $controller.'@detachFeature');
            });
        });
    });
    Api::route('api.admin.features');
});

Route::group(['namespace' => 'Webhooks', 'prefix' => 'webhooks'], function() {
    Route::group(['prefix' => 'viral_loops'], function() {
        Route::name('viral_loops.register')->post('register', 'ViralLoopsController@register');
        Route::name('viral_loops.milestone')->post('milestone', 'ViralLoopsController@milestone');
    });

    Route::group(['prefix' => 'fast_spring'], function() {
        Route::name('fast_spring.subscription')->post('subscription', 'FastSpringController@subscription');
    });
});

Route::group(['namespace' => 'Portal', 'prefix' => 'portal', 'middleware' => ['auth:api']], function() {

    Route::name('api.portal.domain.check')->get('domain/check', 'CheckDomainController@check');

	Route::group(['prefix' => 'keywords'], function() {
		Route::name('api.portal.keywords.create')->post('create', 'KeywordController@create');
		Route::name('api.portal.keywords.delete')->post('delete', 'KeywordController@delete');
	});

	Route::group(['prefix' => 'domains'], function() {
		Route::name('api.portal.domains.create')->post('create', 'DomainController@create');
		Route::name('api.portal.domains.delete')->post('delete', 'DomainController@delete');
	});

	Route::group(['prefix' => 'subscriptions'], function() {
        Route::name('api.portal.subscription.create')->post('create', 'SubscriptionController@create');
        Route::name('api.portal.subscription.update')->post('update', 'SubscriptionController@update');
        Route::name('api.portal.subscription.cancel')->post('cancel', 'SubscriptionController@cancel');
    });

    Api::route('api.portal.companies', ['only' => ['find', 'update']]);
    Api::route('api.portal.user', ['only' => ['find', 'update']]);
	Route::name('api.portal.target')->get('target', 'TargetController@select');
    Route::name('api.portal.competitors.update')->post('competitors/{domain_id}', 'CompetitorController@update');
});
