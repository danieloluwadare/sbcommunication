<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
//    public function render($request, Exception $exception)
//    {
//        return parent::render($request, $exception);
//    }

    public function render($request, Exception $exception)
    {
        if($exception instanceof ValidationException)
        {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if($exception instanceof ModelNotFoundException){
            $model_name= class_basename($exception->getModel());
            $errors="This model {$model_name} does not exist";
            return $this->errorResponse($errors,422);
        }

        if($exception instanceof AuthenticationException)
        {
            return $this->unauthenticated($request, $exception);
        }

        return parent::render($request, $exception);
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse("UnAuthentiacted000",412);

    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {

        $errors = $e->validator->errors()->getMessages();

        return $this->errorResponse($errors,422);

    }
}
