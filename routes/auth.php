<?php

Route::name('auth.register')->get('register', 'RegisterController@showRegisterForm');
Route::name('auth.register.do')->post('register', 'RegisterController@register');

Route::name('auth.login')->get('login', 'LoginController@showLoginForm');
Route::name('auth.login.do')->post('login', 'LoginController@login');

Route::name('auth.forgot-password')->get('forgot-password', 'ForgotPasswordController@showLinkRequestForm');
Route::name('auth.forgot-password.do')->post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail');

Route::name('auth.reset-password')->get('reset-password/{token}', 'ResetPasswordController@showResetForm');
Route::name('auth.reset-password.do')->post('reset-password', 'ResetPasswordController@reset');

Route::name('auth.logout')->get('logout', 'LoginController@logout');

