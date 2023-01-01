<?php

namespace muyomu\auth\utility;

use muyomu\auth\generic\ModeClient;
use muyomu\http\Request;
use muyomu\http\Response;

class ModeExecuteContext
{
    private ModeClient $mode;

    /**
     * @param ModeClient $mode
     */
    public function setMode(ModeClient $mode): void
    {
        $this->mode = $mode;
    }

    public function execute(Request $request,Response $response):void{
        $this->mode->handle($request,$response);
    }
}