<?php

namespace muyomu\log4p\config;

use muyomu\config\annotation\Configuration;
use muyomu\config\base\GenericConfig;

#[Configuration("config_log4p")]
class Log4pDefaultConfig extends GenericConfig
{
    protected array $configData = [
        "log_location"=>"../resource/log"
    ];
}