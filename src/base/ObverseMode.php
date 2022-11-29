<?php

namespace muyomu\auth\base;

use muyomu\auth\client\ModeClient;
use muyomu\auth\client\Realm;
use muyomu\auth\config\DefaultSecurityConfig;
use muyomu\auth\exception\NotCheckedUserException;
use muyomu\auth\utility\CheckRolesAndPrivileges;
use muyomu\auth\utility\Jwt;
use muyomu\http\Request;
use muyomu\http\Response;
use ReflectionClass;
use ReflectionException;

class ObverseMode implements ModeClient
{
    /**
     * @throws ReflectionException
     */
    private static function getRealmInstance():Realm{

        $config = new DefaultSecurityConfig();

        $class  = $config->getOptions("realm");

        $reflectionClass = new ReflectionClass($class);

        return $reflectionClass->newInstance();
    }

    private DefaultSecurityConfig $defaultSecurityConfig;

    private Jwt $jwt;

    private CheckRolesAndPrivileges $checkRolesAndPrivileges;

    public function __construct()
    {
        $this->defaultSecurityConfig = new DefaultSecurityConfig();
        $this->jwt = new Jwt();
        $this->checkRolesAndPrivileges = new CheckRolesAndPrivileges();
    }


    public function handle(Request $request, Response $response): void
    {
        $requestUrl = $request->getDbClient()->select("rule")->getData()->getRoute();

        $obverseUrls = array_keys($this->defaultSecurityConfig->getOptions("obverse"));

        if (!in_array($requestUrl,$obverseUrls)){
            return;
        }

        $token = $request->getHeader($this->defaultSecurityConfig->getOptions("tokenName"));

        if (is_null($token)){
            $response->doExceptionResponse(new NotCheckedUserException(),403);
        }

        $result  = $this->jwt->verifyToken($token);

        if (!$result){
            $response->doExceptionResponse(new NotCheckedUserException(),403);
        }

        try {
            $realm = self::getRealmInstance();

            $payload = $this->jwt->getPayload($token);

            $principle = new Principle();

            $uid = $this->defaultSecurityConfig->getOptions("jwt.identifier");

            $principle->setIdentifier($payload[$uid]);

            $database = $realm->authorization($principle);

            $dataRoles = $database->getRoles();

            $dataPrivileges = $database->getPrivileges();

            $roles = $this->defaultSecurityConfig->getOptions("obverse.{$requestUrl}.roles");

            $privileges = $this->defaultSecurityConfig->getOptions("obverse.{$requestUrl}.privileges");

            if (is_null($roles)){
                $roles = array();
            }

            if (is_null($privileges)){
                $privileges = array();
            }

            if ($this->checkRolesAndPrivileges->check($roles,$dataRoles) && $this->checkRolesAndPrivileges->check($privileges,$dataPrivileges)){
                return;
            }else{
                $response->doExceptionResponse(new NotCheckedUserException(),403);
            }

        }catch (ReflectionException $exception){
            $response->doExceptionResponse(new NotCheckedUserException(),403);
        }
    }
}