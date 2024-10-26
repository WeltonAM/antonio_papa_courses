<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $e)
    {
        parent::report($e);
    }

    public function render($request, Throwable $exception)
    {
        return response([
            'error' => $exception->getMessage(),
        ], $exception->getCode() ?: 400);
    }
}
