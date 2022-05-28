<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
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
    }
    
    private $errorsCodes = [
        '400' => 'BadRequestException',
        '404' => 'NotFoundException',
        '422' => 'BadRequestException',
        '500' => 'InternalServerError',
    ];

    public function render($request, Throwable $exception): JsonResponse
    {
        return $this->handleApiException($request, $exception);
    }

    private function handleApiException($request, Throwable $exception): JsonResponse
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }
        return $this->customApiResponse($exception);
    }

    public function customApiResponse($exception): JsonResponse
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        if (array_key_exists($statusCode, $this->errorsCodes))
            $error['code'] = $this->errorsCodes[$statusCode];

        switch ($statusCode) {
            case 400:
                $error['message'] = 'Something wrong in send data. Check and try again.';
                break;
            case 404:
                $error['message'] = 'The requested resource was not found';
                break;
            case 422:
                $error['message'] = json_decode($exception->getContent())->message;
                $statusCode = 400;
                break;
            case 500:
                $error['message'] = 'Something went wrong. Please try again later.';
                break;
            default:
                $error['message'] = 'Unexpected exception - ' . $exception->getContent();
                break;
        }

        $response['data'] = null;
        $response['errors'] = [$error];
        return response()->json($response, $statusCode);
    }
}
