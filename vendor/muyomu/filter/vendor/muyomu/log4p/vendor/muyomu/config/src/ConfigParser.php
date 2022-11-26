<?php

namespace muyomu\config;

use muyomu\config\annotation\Configuration;
use muyomu\config\utility\ConfigUtility;
use ReflectionClass;
use ReflectionException;

class ConfigParser
{
    /**
     * @var ConfigUtility
     */
    private ConfigUtility $utility;


    public function __construct()
    {
        $this->utility = new ConfigUtility();
    }

    /**
     * @param string $configClassName
     * @return array
     */
    public function getConfigData(string $configClassName):array{
        $reflectionClass = $this->utility->getConfigClassInstance($configClassName);
        $attribute = $this->utility->getAttributeClassInstance($reflectionClass,Configuration::class);
        $configField = $attribute->newInstance()->getConfigField();
        if ($this->checkForField($configField)){
            $defaultData = $this->getDefaultConfigData($configClassName);
            return $this->resolveConfigData($GLOBALS[$configField], $defaultData);
        }else{
            return $this->getDefaultConfigData($configClassName);
        }
    }

    /**
     * @param string $field
     * @return bool
     */
    private function checkForField(string $field):bool{
        if (isset($GLOBALS[$field])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param array $fieldData
     * @param array $defaultData
     * @return array
     */
    private function resolveConfigData(array &$fieldData, array &$defaultData):array{
        $keys = array_keys($defaultData);
        foreach ($keys as $key){
            if (is_array($defaultData[$key])){
                if ($this->checkForAssocArray($defaultData[$key])){
                    $this->resolveConfigData($fieldData[$key],$defaultData[$key]);
                }else{
                    if ((gettype($fieldData[$key]) == gettype($defaultData[$key])) && isset($fieldData[$key])){
                        $defaultData[$key] = $fieldData[$key];
                    }
                }
            }else{
                if ((gettype($fieldData[$key]) == gettype($defaultData[$key])) && isset($fieldData[$key])){
                    $defaultData[$key] = $fieldData[$key];
                }
            }
        }
        return $defaultData;
    }

    /**
     * @param string $className
     * @return array
     */
    private function getDefaultConfigData(string $className):array{
        $configData = array();
        try {
            $reflectionClass = new ReflectionClass($className);
            $reflectionMethod = $reflectionClass->getMethod("getConfigData");
            $reflectionClassInstance = $reflectionClass->newInstance();
            $configData = $reflectionMethod->invoke($reflectionClassInstance);
        }catch (ReflectionException $exception){

        }
        return $configData;
    }

    /**
     * @param array $item
     * @return bool
     */
    private function checkForAssocArray(array $item):bool{
        $index = 0;
        $keys = array_keys($item);
        foreach ($keys as $key){
            if ($index == $key){
                $index++;
            }else{
                return false;
            }
        }
        return true;
    }
}