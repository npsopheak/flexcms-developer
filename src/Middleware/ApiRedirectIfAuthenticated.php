<?php

namespace FlexCMS\BasicCMS\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use \FlexAuth;

class ApiRedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (FlexAuth::isLogin('user')) {
            return redirect(config('flexcms.app.route.authorized'));
        }
        return $next($request);
    }
}
