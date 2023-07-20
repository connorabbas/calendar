<?php

namespace App\Exceptions;

use Exception;

class PermissionDeniedException extends Exception
{
    public function __construct(
        $message = "Permission Denied.",
        $code = 403,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}