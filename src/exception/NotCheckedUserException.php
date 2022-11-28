<?php

namespace muyomu\auth\exception;

use Exception;

class NotCheckedUserException extends Exception
{

    public function __construct()
    {
        parent::__construct("NotCheckedUserException");
    }
}