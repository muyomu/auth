<?php

namespace muyomu\auth\client;

use muyomu\auth\base\Authenticator;
use muyomu\auth\base\Authorizator;
use muyomu\auth\base\Principle;

interface Realm{

    public function authorization(Principle $principle):Authorizator;

    public function authentication(Principle $principle):Authenticator;

}