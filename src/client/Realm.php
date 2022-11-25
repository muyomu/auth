<?php

namespace muyomu\auth\client;

use Muyomu\Auth\base\Authenticator;
use Muyomu\Auth\base\Authorizator;

interface Realm{
    public function authorization(array $payload):Authorizator;

    public function authentication(array $payload):Authenticator;
}