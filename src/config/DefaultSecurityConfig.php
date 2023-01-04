<?php

namespace muyomu\auth\config;

use muyomu\auth\utility\DefaultRealm;
use muyomu\config\annotation\Configuration;
use muyomu\config\GenericConfig;

#[Configuration(DefaultSecurityConfig::class)]
class DefaultSecurityConfig extends GenericConfig
{
    protected string $configClass = self::class;

    protected array $configData = [
        "security"=>false,
        "mode"=>"obverse",
        "tokenName"=>"token",
        "obverse"=>[],
        "realm"=>DefaultRealm::class,
        "jwt"=>[
            "header"=>[
                "alg"=>"HS256",
                "type"=>"JWT"
            ],
            "key"=>"123456",
            "identifier"=>"uid"
        ]
    ];
}