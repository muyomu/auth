<?php

namespace muyomu\auth\utility;

use muyomu\auth\base\Authenticator;
use muyomu\auth\base\Authorizator;
use muyomu\auth\base\Principle;
use muyomu\auth\client\Realm;

class DefaultRealm implements Realm
{

    public function authorization(Principle $principle): Authorizator
    {
        $test = new Authorizator();
        $test->setRoles(array("one"));
        $test->setPrivileges(array("two"));
        return $test;
    }

    public function authentication(Principle $principle): Authenticator
    {
        return new Authenticator();
    }
}