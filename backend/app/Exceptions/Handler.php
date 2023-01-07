<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{

    use ResponseTrait;
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
        
    }


    public function render($request, Throwable $ex)
    {

        if ($ex instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException && request()->wantsJson()) {
            return $this->invalidMethodResponse();
        }
        if ($ex instanceof ModelNotFoundException && request()->wantsJson()) {
            return $this->notFoundResponse();
        }

        if ($ex instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException && request()->wantsJson()) {
            return $this->invalidEndpointResponse();
        }


        return parent::render($request, $ex);
    }
}
