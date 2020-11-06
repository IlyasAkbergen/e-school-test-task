<?php

namespace App\Exceptions;

use App\Http\Utils\ApiUtil;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (ApiUtil::checkUrlIsApi($request)) {
            return $this->handleApiException($request, $exception);
        } else {
            return parent::render($request, $exception);
        }

    }

    private function handleApiException($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof ApiServiceException) {
            return $exception->getApiResponse();
        }
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'error' => 'Unauthenticated',
                'message' => $exception->getMessage()], 401
            );
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['error' => 'Bad Request'], 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return parent::render($request, $exception);
    }
}
