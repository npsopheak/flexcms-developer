<?php

namespace FlexCMS\BasicCMS\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use \FlexAuth;

class ApiAuthenticate extends BaseMiddleware
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
        
        if (!FlexAuth::isLogin('user')) {
            if ($request->ajax() || $request->is('api/*')) {
                return $this->error('Unauthorized.', null, null, 401);
            } else {

                return redirect()->guest(config('flexcms.app.route.unauthorized'));
            }
        }
        else{
        	
        }
        return $next($request);        
    }
}
