<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\DomainKeyword;
use App\Policies\KeywordPolicy;
use App\Models\Company;
use App\Policies\CompanyPolicy;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Domain;
use App\Policies\DomainPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        DomainKeyword::class => KeywordPolicy::class,
        Company::class => CompanyPolicy::class,
        User::class => UserPolicy::class,
        Domain::class => DomainPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
