<?php

namespace App\Service\Validator;

interface UrlValidatorInterface
{
    /**
     * @param String $url
     * @return bool
     */
    public function validateUrl(String $url): bool;
}