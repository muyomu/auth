<?php

namespace muyomu\config\base;

abstract class GenericConfig
{
    protected array $configData = array();

    /**
     * @return array
     */
    public function getConfigData(): array
    {
        return $this->configData;
    }
}