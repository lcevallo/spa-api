<?php

namespace App\Http\Middleware;
use Closure;

class ContenedorResponse
{
	public function handle($request, Closure $next){
		$response = $next($request);

		if($response instanceof JsonResponse)
		{
			if(!isset($response->getData()->status))
			{
				$newResponseData['status'] = 'success';
				$newResponseData['code'] = $response->getStatusCode();
				$newResponseData['data'] = $response->getCode();

				$response->setData($newResponseData);
			}
		}

		return $response;
	}

}