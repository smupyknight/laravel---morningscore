<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use MorningTrain\Foundation\Context\Context;

class DashboardController extends Controller
{

    public function index()
    {
        return Context::render('templates.dashboard');
    }

}