<?php

namespace muyomu\auth\utility;

class CheckRolesAndPrivileges
{
    public function check(array $required, array $database):bool{
        foreach ($required as $value){
            if (!in_array($value,$database)){
                return false;
            }
        }
        return true;
    }
}