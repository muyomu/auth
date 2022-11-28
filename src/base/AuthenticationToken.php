<?php

namespace muyomu\auth\base;

class AuthenticationToken
{
    private string $principle;

    private string $credential;

    /**
     * @return string
     */
    public function getPrinciple(): string
    {
        return $this->principle;
    }

    /**
     * @param string $principle
     */
    public function setPrinciple(string $principle): void
    {
        $this->principle = $principle;
    }
}