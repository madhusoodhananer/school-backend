<?php

namespace App\Exceptions;

use Exception;
use Throwable;
class SchoolException extends Exception
{
    private int $statusCode;
    private array|string $data;
    public function __construct
    (
        int $statusCode,
        string $message,
        array|string $data=[],
        Throwable $previous=null,
        int $code=0
    )
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
        parent::__construct($message,$code,$previous);
    }

    public function getStatusCode():int
    {
        return $this->statusCode;
    }
    public function getData():array|string
    {
        return $this->data;
    }
}
