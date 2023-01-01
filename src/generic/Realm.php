<?php

namespace muyomu\auth\generic;

use muyomu\auth\foundation\Authenticator;
use muyomu\auth\foundation\Authorizator;
use muyomu\auth\foundation\Principle;

interface Realm{

    public function authorization(Principle $principle):Authorizator;

    public function authentication(Principle $principle):Authenticator;

}