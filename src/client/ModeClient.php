<?php

namespace muyomu\auth\client;

use muyomu\http\Request;
use muyomu\http\Response;

interface ModeClient
{
    public function handle(Request $request,Response $response):void;
}