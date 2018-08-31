<?php

Route::name('admin')->get('', function () {
    return redirect()->route('admin.dashboard');
});

Route::name('admin.dashboard')->get('dashboard', 'DashboardController@index');