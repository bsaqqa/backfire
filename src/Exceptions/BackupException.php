<?php

namespace BSaqqa\Backfire\Exceptions;

use Throwable;

class BackupException extends \Exception
{
    public array $data = [];

    /**
     * @param  string  $message
     * @param  array  $data
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct($message = "", array $data = [], $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

}