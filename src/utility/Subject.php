<?php

namespace muyomu\auth\utility;

use muyomu\auth\foundation\AuthenticationToken;
use muyomu\auth\foundation\Principle;
use muyomu\auth\generic\Realm;
use muyomu\auth\config\DefaultSecurityConfig;
use muyomu\log4p\Log4p;
use ReflectionClass;
use ReflectionException;

class Subject
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

    /**
     * @param AuthenticationToken $token
     * @return bool
     */
    public static function login(AuthenticationToken $token):bool{
        $log4p = new Log4p();
        try {
            $realmInstance = self::getRealmInstance();
        }catch (ReflectionException $exception){
            $log4p->muix_log_error(__CLASS__,__METHOD__,__LINE__,$exception->getMessage());
            return false;
        }

        $principle = new Principle();

        $principle->setIdentifier($token->getPrinciple());

        $authenticator = $realmInstance->authentication($principle);

        $siteCredentials = $authenticator->getSiteCredentials();

        if ($siteCredentials == $token->getCredential()){
            return true;
        }else{
            return false;
        }
    }
}