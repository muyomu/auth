<?php

namespace muyomu\auth\utility;

use Muyomu\Auth\base\Authenticator;
use Muyomu\Auth\base\Authorizator;
use muyomu\auth\base\Principle;
use muyomu\auth\client\Realm;

class DefaultRealm implements Realm
{

    public function authorization(Principle $principle): Authorizator
    {
        return new Authorizator();
    }

    public function authentication(Principle $principle): Authenticator
    {
        return new Authenticator();
    }
}