<?php

namespace muyomu\auth\generic;

use muyomu\auth\fundation\Authenticator;
use muyomu\auth\fundation\Authorizator;
use muyomu\auth\fundation\Principle;

interface Realm{

    public function authorization(Principle $principle):Authorizator;

    public function authentication(Principle $principle):Authenticator;

}