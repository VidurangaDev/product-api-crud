<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of inputs that are never flashed for validation exceptions.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register exception handling callbacks.
     */
    public function register(): void
    {
        // You can log custom exceptions here if needed
    }

    /**
     * Render exceptions into HTTP responses.
     */
    public function render($request, Throwable $exception)
    {

        if ($request->is('api/*')) {

            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $exception->errors()
                ], 422);
            }

            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Resource not found'
                ], 404);
            }

            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated'
                ], 401);
            }


            return response()->json([
                'status' => false,
                'message' => 'Server Error',
                'error' => env('APP_DEBUG') ? $exception->getMessage() : null
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
