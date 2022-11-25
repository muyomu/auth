<?php

namespace muyomu\auth\exception;

use Exception;

class TokenExpiredException extends Exception
{
    public function __construct()
    {
        parent::__construct();
    }
}