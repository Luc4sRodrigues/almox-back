<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Inertia\Response as InertiaResponse;

class CORS
{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		// header("Access-Control-Allow-Origin: * "); // está enviando múltiplos valores para o cabeçalho 'Access-Control-Allow-Origin'

		// ALLOW OPTIONS METHOD
		$headers = [
			'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
			'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin'
		];
		if ($request->getMethod() == "OPTIONS") {
			// The client-side application can set only headers allowed in Access-Control-Allow-Headers
			return Response::make('OK', 200, $headers);
		}

		$response = $next($request);
		foreach ($headers as $key => $value)
			$response->header($key, $value);
		return $response;
	}
}
