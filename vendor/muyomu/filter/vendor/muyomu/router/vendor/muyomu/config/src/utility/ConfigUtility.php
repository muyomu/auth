<?php

namespace muyomu\config\utility;

use muyomu\config\client\UtilityClient;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;

class ConfigUtility implements UtilityClient
{

    public function getConfigClassInstance(string $className): ReflectionClass
    {
        $reflectionClass = null;

        try {
            $reflectionClass = new ReflectionClass($className);
        }catch (ReflectionException $exception){

        }
        return $reflectionClass;
    }

    public function getAttributeClassInstance(ReflectionClass $reflectionClass,string $attributeClass): ReflectionAttribute
    {
        $attributes = $reflectionClass->getAttributes($attributeClass);
        if (empty($attributes)){

        }else{
            return $attributes[0];
        }
    }
}