<?php

namespace ManelGavalda\TodosBackend\Exceptions;

use ErrorException;
use Exception;
use HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Response;

/**
 * Class Handler.
 */
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
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception                $exception
     *
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return Response::json([
                'error'  => 'Hi ha hagut una excepció de model no trobat, error: '.$exception->getMessage(),
                'code'   => 10,
                'status' => 404,
            ], 404);
        }

        if ($exception instanceof IncorrectModelException) {
            return Response::json([
                'error'  => 'Hi ha hagut una excepció de model incorrecte, error: '.$exception->getMessage(),
                'code'   => 10,
                'status' => 404,
            ], 404);
        }

        if ($exception instanceof ErrorException) {
            return Response::json([
                'error'  => 'Hi ha hagut una excepció, error: '.$exception->getMessage(),
                'code'   => 10,
                'status' => 404,
            ], 404);
        }

        if ($exception instanceof HttpException) {
            return Response::json([
                'error'   => 'Hi ha hagut una excepció http, error: '.$exception->getMessage(),
                'code'    => 10,
                'status'  => 403,
            ], 404);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
