<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // DB::rollback();
            // return response()->json(['errors' => $e->getMessage()], $e->getCode());
        });

        // $this->reportable(function (ValidationException $e) {
        //     DB::rollback();
        //     return response()->json(['errors' => $e->errors()], $e->status);
        // });

        // $this->reportable(function (MissingAbilityException $e) {
        //     DB::rollback();
        //     return response()->json([
        //         'error' => $e->getMessage()
        //     ], Response::HTTP_UNAUTHORIZED);
        // });

        // $this->reportable(function (BadMethodCallException $e) {
        //     DB::rollback();
        //     return response()->json([
        //     'error' => $e->getMessage()
        // ], 500);
        // });

        // $this->reportable(function (HttpException $e) {
        //     DB::rollback();
        // return response()->json([
        //     'error' => $e->getMessage()
        // ], $e->getStatusCode());
        // });

        // $this->reportable(function (AuthenticationException $e) {
        //     DB::rollback();
        //     return response()->json([
        //         'error' => $e->getMessage()
        //     ], Response::HTTP_UNAUTHORIZED);
        // });

        // $this->reportable(function (ModelNotFoundException $e) {
        //     DB::rollback();
        //     $replacement = [
        //         'id' => collect($e->getIds())->first(),
        //         'model' => Arr::last(explode('\\', $e->getModel())),
        //     ];
    
        //     $error = new Error(
        //         trans('exception.model_not_found.help'),
        //         trans('exception.model_not_found.error', $replacement)
        //     );
        //     return response($error->toArray(), Response::HTTP_NOT_FOUND);
        // });
    }
}

