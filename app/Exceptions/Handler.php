<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;

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

    public function report(Throwable $exception)
    {
	parent::report($exception);
    }

    public function shouldReport(Throwable $exception)
    {
	dd($exception);
    }

    public function render($request, Throwable $exception)
    {
	return parent::render($request, $exception);
    }

    public function renderForConsole($output, Throwable $exception)
    {
	dd($exception);
    }
}
