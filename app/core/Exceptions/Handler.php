<?php

namespace App\Exceptions;

use App\Http\Controllers\teste;
use BadMethodCallException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            //
        });

        //     $this->renderable(function (Throwable $e) {
        //         //DB::rollback();
        //         return response()->json(['errors' => $e->getMessage()], $e->getCode());
        //    });

        //     $this->renderable(function (ValidationException $e) {
        //         DB::rollback();
        //         return response()->json(['errors' => $e->errors()], $e->status);
        //     });

        //     $this->renderable(function (MissingAbilityException $e) {
        //         DB::rollback();
        //         return response()->json([
        //             'error' => $e->getMessage()
        //         ], Response::HTTP_UNAUTHORIZED);
        //     });

        //     $this->renderable(function (BadMethodCallException $e) {
        //         DB::rollback();
        //         return response()->json([
        //         'error' => $e->getMessage()
        //     ], 500);
        //     });

        //     $this->renderable(function (HttpException $e) {
        //         DB::rollback();
        //     return response()->json([
        //         'error' => $e->getMessage()
        //     ], $e->getStatusCode());
        //     });

        //     $this->renderable(function (AuthenticationException $e) {
        //         DB::rollback();
        //         return response()->json([
        //             'error' => $e->getMessage()
        //         ], Response::HTTP_UNAUTHORIZED);
        //     });

        //     $this->renderable(function (ModelNotFoundException $e) {
        //         dd($e);
        //         //DB::rollback();
        //         $replacement = [
        //             'id' => collect($e->getIds())->first(),
        //             'model' => Arr::last(explode('\\', $e->getModel())),
        //         ];

        //         $error = new Error(
        //             trans('exception.model_not_found.help'),
        //             trans('exception.model_not_found.error', $replacement)
        //         );

        //         dd($error->toArray());
        //         return response($error->toArray(), Response::HTTP_NOT_FOUND);
        //     });


    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {

        if ($e instanceof ModelNotFoundException) {
            $replace = [
                'id' => collect($e->getIds())->first(),
                'model' => Arr::last(explode('\\', $e->getModel())),
                'trace' => $e->getTraceAsString(),
                'msg' => $e->getMessage(),
            ];
            $error = new Error(
                help: trans('messages.error.model.not.found', $replace),
                error: trans('messages.help.model.not.found', $replace),
                stackTrace: trans('messages.stachTrace.model.not.found', $replace),
                message: trans('messages.msg.model.not.found', $replace),
            );
            return  response()->json(['error' => trans('messages.error.model.not.found', $replace)], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof ValidationException) {
            // $replace = [
            //     'id' => collect($e->get())->first(),
            //     'model' => Arr::last(explode('\\', $e->getModel())),
            //     'trace' => $e->getTraceAsString(),
            //     'msg' => $e->getMessage(),
            // ];
            // $error = new Error(
            //     help: trans('messages.error.model.not.found', $replace),
            //     error: trans('messages.help.model.not.found', $replace),
            //     stackTrace: trans('messages.stachTrace.model.not.found', $replace),
            //     message: trans('messages.msg.model.not.found', $replace),
            // );
            return response()->json(['errors' => $e->errors()], $e->status);
        }

        return parent::render($request, $e);
    }
}
