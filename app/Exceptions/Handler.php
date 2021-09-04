<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        'current_password',
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
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e){
            $errors = null;
            $status_code = 500;
            
            if($e instanceof ValidationException){
                $errors = $e->errors();
                $status_code = 422;
            }

            if($e instanceof HttpException){
                $status_code = $e->getStatusCode();
            }

            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $errors
            ], $status_code);
        });
    }
}
