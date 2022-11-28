<?php

namespace muyomu\auth\base;

use muyomu\auth\client\ModeClient;
use muyomu\auth\config\DefaultSecurityConfig;
use muyomu\auth\exception\NotCheckedUserException;
use muyomu\auth\utility\Jwt;
use muyomu\http\Request;
use muyomu\http\Response;

class ObverseMode implements ModeClient
{
    private DefaultSecurityConfig $defaultSecurityConfig;

    private Jwt $jwt;

    public function __construct()
    {
        $this->defaultSecurityConfig = new DefaultSecurityConfig();
        $this->jwt = new Jwt();
    }


    public function handle(Request $request, Response $response): void
    {
        $token = $request->getHeader($this->defaultSecurityConfig->getOptions("tokenName"));

        if (is_null($token)){
            $response->doExceptionResponse(new NotCheckedUserException(),403);
        }

        $result  = $this->jwt->verifyToken($token);

        if (!$result){
            $response->doExceptionResponse(new NotCheckedUserException(),403);
        }
    }
}