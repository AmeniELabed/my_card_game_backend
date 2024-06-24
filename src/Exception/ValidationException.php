<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidationException extends HttpException
{
    public function __construct(string $message = 'Validation failed', int $statusCode = Response::HTTP_BAD_REQUEST, \Throwable $previous = null)
    {
        parent::__construct($statusCode, $message, $previous);
    }
}
