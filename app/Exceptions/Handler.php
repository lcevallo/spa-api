<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
   public function render($request, Exception $e)
 
    {
 
        $rendered = parent::render($request, $e);
 
 
        if(env('RENDER_EXCEPTIONS',true))
 
        {
 
            if($e instanceOf ValidationException)                // Excepción por no pasar validación
 
            {
 
                $code= 400;
 
                $responseData['status'] = 'Error';
 
                $responseData['data'] = $e->response->getData();
 
                $responseData['code'] = $code;
 
            }
 
            else if ( ($e instanceOf HttpException)
 
                    || ($e instanceOf NotFoundHttpException)
 
                    || ($e instanceOf ModelNotFoundException) ) // Excepción por url mal formada
 
            {
 
                $code = 404;
 
                $responseData['status'] = 'Petición invalida';
 
                $responseData['code'] = $code;
 
                $responseData['message'] = 'No encontrado';
 
            }
 
            else if ($e instanceOf AccessDeniedException)        // Excepción por Acceso Denegado
 
            {
 
                $code = 401;
 
                $responseData['status'] = 'error';
 
                $responseData['code'] = $code;
 
                $responseData['message'] = 'No autorizado';

                $header['WWW-Authenticate'] = 'Bearer';
 
            }


            /** else if ($e instanceOf ClientException)              //Guzzle ClientException
 
            {
 
                //var_dump($e);
 
                $code = 503;
 
                $responseData['status'] = 'error';
 
                $responseData['code'] = $code;
 
                $responseData['message'] = 'Error when connecting with external service';
 
                $responseData['data']['message'] = $e->getMessage();
 
 
            }
 
            else if ($e instanceOf Google_Exception)
 
            {
 
                $code = 503;
 
                $responseData['status'] = 'error';
 
                $responseData['code'] = $code;
 
                $responseData['message'] = 'Error when connecting with external service';
 
                $responseData['data']['message'] = $e->getErrors();
 
            }
            */
 
            else                                                 // Excepción desconocida
 
            {
 
                $code = 500;
 
                $responseData['status'] = 'error';
 
                $responseData['code'] = $code;
 
                $responseData['message'] = 'Error interno';
 
                $responseData['data']['Tipo de excepcion'] = get_class($e);
 
            }
 
            return response()->json($responseData, isset($code)? $code : 200, isset($headers) ? $headers : []);
 
        }
 
    }


}
