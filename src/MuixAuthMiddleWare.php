<?php

namespace muyomu\auth;

use muyomu\auth\base\FilterMode;
use muyomu\auth\base\ObverseMode;
use muyomu\auth\config\DefaultSecurityConfig;
use muyomu\auth\utility\ModeExecuteContext;
use muyomu\http\Request;
use muyomu\http\Response;
use muyomu\log4p\Log4p;
use muyomu\middleware\BaseMiddleWare;

class MuixAuthMiddleWare implements BaseMiddleWare {

    private DefaultSecurityConfig $defaultSecurityConfig;

    private ModeExecuteContext $context;

    private Log4p $log4p;

    public function __construct()
    {
        $this->defaultSecurityConfig = new DefaultSecurityConfig();
        $this->context = new ModeExecuteContext();
        $this->log4p = new Log4p();
    }

    public function handle(Request $request, Response $response): void
    {
        $security = $this->defaultSecurityConfig->getOptions("security");
        if ($security){
            $mode = $this->defaultSecurityConfig->getOptions("mode");
            if ($mode == "obverse"){
                $this->context->setMode(new ObverseMode());
                $this->context->execute($request,$response);
            }else if ($mode == "filter"){
                $this->context->setMode(new FilterMode());
                $this->context->execute($request,$response);
            }else{
                $this->log4p->muix_log_error(__CLASS__,__METHOD__,__LINE__,"UnRecognized Mode {$mode}");
            }
        }
    }
}