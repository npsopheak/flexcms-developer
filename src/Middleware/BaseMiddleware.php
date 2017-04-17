<?php namespace FlexCMS\BasicCMS\Middleware;
use Illuminate\Http\Response;
class BaseMiddleware {

	protected function ok($content, $options = null, $code = null, $status = 200){
		$result = [
			'result' => $content,
			'options' => $options,
			'code' => $code
		];
		return (new Response($result, $status))
                  ->header('Content-Type', 'application/json');
	}

	protected function error($content, $options = null, $code = null, $status = 400){

		$result = [
			'result' => $content,
			'options' => $options,
			'code' => $code
		];

		return (new Response($result, $status))
                  ->header('Content-Type', 'application/json');
	}
}
