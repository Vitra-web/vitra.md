<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\ViewErrorBag;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }
   public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', ['errors' => new ViewErrorBag,
                'exception' => $exception], 404);
        }

        if ($exception instanceof ServiceUnavailableHttpException) {
            return response()->view('errors.500', ['errors' => new ViewErrorBag,
                'exception' => $exception], 500);
        }
        return parent::render($request, $exception);

//        if ($this->isHttpException($exception)) {
//            if ($exception->getStatusCode() == 404) {
//                return response()->view('client.errors.404', [], 404);
//            }
//            if ($exception->getStatusCode() == 500) {
//                return response()->view('client.errors.500', [], 500);
//            }
//        }
//        return parent::render($request, $exception);
    }
}
