<?php

namespace muyomu\auth\client;

use Muyomu\Auth\base\Authenticator;
use Muyomu\Auth\base\Authorizator;
use muyomu\auth\base\Principle;

interface Realm{

    public function authorization(Principle $principle):Authorizator;

    public function authentication(Principle $principle):Authenticator;

}