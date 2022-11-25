<?php

namespace muyomu\auth\annotation;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Realm
{
    public function __construct()
    {
    }
}