<?php

namespace muyomu\log4p\exception;

use Exception;

class LogFileOpenFailedException extends Exception
{

    public function __construct(string $fileName)
    {
        parent::__construct("Failed to open the file ${$fileName}");
    }
}