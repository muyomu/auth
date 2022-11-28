<?php

namespace muyomu\auth\base;

class AuthenticationToken
{
    private string $principle;

    private string $credential;

    /**
     * @param string $principle
     * @param string $credential
     */
    public function __construct(string $principle, string $credential)
    {
        $this->principle = $principle;
        $this->credential = $credential;
    }

    /**
     * @return string
     */
    public function getPrinciple(): string
    {
        return $this->principle;
    }

    /**
     * @return string
     */
    public function getCredential(): string
    {
        return $this->credential;
    }
}