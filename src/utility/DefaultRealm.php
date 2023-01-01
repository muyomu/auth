<?php

namespace muyomu\auth\utility;

use muyomu\auth\foundation\Authenticator;
use muyomu\auth\foundation\Authorizator;
use muyomu\auth\foundation\Principle;
use muyomu\auth\generic\Realm;

class DefaultRealm implements Realm
{

    public function authorization(Principle $principle): Authorizator
    {
        $default = new Authorizator();
        $default->setRoles(array());
        $default->setPrivileges(array());
        return $default;
    }

    public function authentication(Principle $principle): Authenticator
    {
        $default = new Authenticator();
        $default->setSiteCredentials("");
        return $default;
    }
}