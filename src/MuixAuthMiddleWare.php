<?php

namespace muyomu\auth;

use muyomu\auth\config\DefaultSecurityConfig;
use muyomu\http\Request;
use muyomu\http\Response;
use muyomu\middleware\BaseMiddleWare;

class MuixAuthMiddleWare implements BaseMiddleWare {

    private DefaultSecurityConfig $defaultSecurityConfig;

    public function __construct()
    {
        $this->defaultSecurityConfig = new DefaultSecurityConfig();
    }


    public function handle(Request $request, Response $response): void
    {
        $urls = $this->defaultSecurityConfig->getOptions("obverse");

        $route = $request->getDbClient()->select("rule")->getData()->getRoute();

        if (array_key_exists($route,$urls)){
            die("需要验证");
        }else{
            die("不需要验证");
        }
    }
}