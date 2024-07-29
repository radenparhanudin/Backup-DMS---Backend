<?php

namespace App\Exceptions;

use App\Facades\ResponseJson;
use BadMethodCallException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                if ($e instanceof AuthenticationException) {
                    return ResponseJson::error(
                        message: 'User is not logged in.',
                        code: Response::HTTP_UNAUTHORIZED
                    );
                } elseif ($e instanceof ValidationException) {
                    return ResponseJson::error(
                        message: $e->errors(),
                        code: Response::HTTP_UNPROCESSABLE_ENTITY
                    );
                } elseif ($e instanceof MethodNotAllowedHttpException) {
                    return ResponseJson::error(
                        message: $e->getMessage(),
                        code: $e->getStatusCode()
                    );
                } elseif ($e instanceof BadMethodCallException) {
                    return ResponseJson::error(
                        message: $e->getMessage(),
                        code: Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                } elseif ($e instanceof QueryException) {
                    return ResponseJson::error(
                        message: $e->errorInfo[2],
                        code: Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                } elseif ($e instanceof UnauthorizedException) {
                    return ResponseJson::error(
                        message: $e->getMessage(),
                        code: $e->getStatusCode()
                    );
                } elseif ($e instanceof NotFoundHttpException) {
                    return ResponseJson::error(
                        message: 'Data tidak ditemukan!',
                        code: $e->getStatusCode()
                    );
                } elseif ($e instanceof RouteNotFoundException) {
                    return ResponseJson::error(
                        message: 'User is not logged in.',
                        code: Response::HTTP_UNAUTHORIZED
                    );
                } elseif ($e instanceof ConnectionException) {
                    $pattern = '/(https?:\/\/[^\s]+)/';
                    preg_match_all($pattern, $e->getMessage(), $matches);
                    preg_match('/^(?:https?:\/\/)?(?:www\.)?([^\/]+)/i', $matches[0][1], $matches);
                    $domain = isset($matches[1]) ? $matches[1] : '';

                    return ResponseJson::error(
                        message: "Connection Time Out : $domain",
                        code: Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                } else {
                    return ResponseJson::error(
                        message: $e->getMessage(),
                        code: Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }
        });
    }
}
