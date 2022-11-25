<?php

namespace muyomu\auth\base;

class Authenticator
{
    private string $requestCredential;

    private string $siteCredentials;

    /**
     * @return string
     */
    public function getRequestCredential(): string
    {
        return $this->requestCredential;
    }

    /**
     * @param string $requestCredential
     */
    public function setRequestCredential(string $requestCredential): void
    {
        $this->requestCredential = $requestCredential;
    }

    /**
     * @return string
     */
    public function getSiteCredentials(): string
    {
        return $this->siteCredentials;
    }

    /**
     * @param string $siteCredentials
     */
    public function setSiteCredentials(string $siteCredentials): void
    {
        $this->siteCredentials = $siteCredentials;
    }
}