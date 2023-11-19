<?php

namespace App\Service\Validator;

interface UrlValidatorInterface
{
    /**
     * @param string $url
     * @return bool
     */
    public function validateUrl(string $url): bool;
}