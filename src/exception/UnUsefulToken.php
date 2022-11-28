<?php

namespace muyomu\auth\exception;

use Exception;

class UnUsefulToken extends Exception
{
    public function __construct()
    {
        parent::__construct("UnUsefulToken");
    }
}