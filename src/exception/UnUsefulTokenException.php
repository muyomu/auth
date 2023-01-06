<?php

namespace muyomu\auth\exception;

use Exception;

class UnUsefulTokenException extends Exception
{
    public function __construct()
    {
        parent::__construct("UnUsefulTokenException");
    }
}