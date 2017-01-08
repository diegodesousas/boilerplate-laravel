<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\OAuth2\Server\Exception\OAuthServerException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $default_response = parent::render($request, $exception);

        return $this->handleDefaultResponse($default_response, $request, $exception);
    }

    /**
     * Tratamento default para os erros inesperados da aplicação
     *
     * @param Response $response
     * @param Request $request
     * @param Exception $exception
     * @return JsonResponse|Response
     */
    protected function handleDefaultResponse(Response $response, Request $request, Exception $exception)
    {
        $response = new JsonResponse([
            'type' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'code' => $exception->getCode()
        ], $response->getStatusCode());

        return $response;
    }

    protected function prepareException(Exception $exception)
    {
        $e = parent::prepareException($exception);

        if ($e instanceof OAuthServerException) {

            $e = new HttpException(401, $e->getMessage());
        }

        return $e;
    }
}
