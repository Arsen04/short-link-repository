<?php

namespace App\DependencyInjection\LinkExpirationChecker\Exception;

interface LinkExpirationExceptionInterface
{
    /**
     * @return array
     */
    public function getExpirationErrors(): array;
}