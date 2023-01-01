<?php

namespace muyomu\auth\utility;

use muyomu\auth\fundation\Authenticator;
use muyomu\auth\fundation\Authorizator;
use muyomu\auth\fundation\Principle;
use muyomu\auth\generic\Realm;

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