<?php

namespace MorningTrain\Foundation\Acl\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use \Closure;

class HasRole
{

    /**
     * @var Auth
     */
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        // Check if authenticated
        if (!$this->auth->check()) {
            throw new AuthenticationException('Unauthenticated.');
        }

        $roles = array_slice(func_get_args(), 2);

        if (is_array($roles) && !empty($roles) && !$this->auth->user()->isAssignedEither($roles)) {
            return abort(403, 'Forbidden');
        }

        return $next($request);
    }

}