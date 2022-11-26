<?php

namespace muyomu\config\exception;

use Exception;

class FieldConfigException extends Exception
{

    public function __construct()
    {
        parent::__construct("FieldType Not Match");
    }
}