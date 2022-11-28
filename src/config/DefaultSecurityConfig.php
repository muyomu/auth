<?php

namespace muyomu\auth\config;

use muyomu\config\annotation\Configuration;
use muyomu\config\GenericConfig;

#[Configuration("security")]
class DefaultSecurityConfig extends GenericConfig
{
    protected string $configClass = self::class;

    protected array $configData = [];
}