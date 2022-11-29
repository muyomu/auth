<?php

namespace muyomu\auth;

use muyomu\auth\base\ObverseMode;
use muyomu\auth\config\DefaultSecurityConfig;
use muyomu\auth\utility\ModeExecuteContext;
use muyomu\http\Request;
use muyomu\http\Response;
use muyomu\middleware\BaseMiddleWare;

class MuixAuthMiddleWare implements BaseMiddleWare {

    private DefaultSecurityConfig $defaultSecurityConfig;

    private ModeExecuteContext $context;

    public function __construct()
    {
        $this->defaultSecurityConfig = new DefaultSecurityConfig();
        $this->context = new ModeExecuteContext();
    }

    public function handle(Request $request, Response $response): void
    {
        $security = $this->defaultSecurityConfig->getOptions("security");
        if ($security){
            $this->context->setMode(new ObverseMode());
            $this->context->execute($request,$response);
        }
    }
}