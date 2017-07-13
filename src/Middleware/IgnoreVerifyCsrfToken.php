<?php namespace FlexCMS\BasicCMS\Middleware;

use Closure;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class IgnoreVerifyCsrfToken extends BaseVerifier{

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
