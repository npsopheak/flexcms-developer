<?php namespace FlexCMS\BasicCMS\Middleware;

use Closure;

class IgnoreVerifyCsrfToken extends {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$next($request);
	}

}
