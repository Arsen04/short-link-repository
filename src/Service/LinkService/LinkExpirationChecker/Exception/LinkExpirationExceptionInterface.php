<?php

namespace App\Service\LinkService\LinkExpirationChecker\Exception;

interface LinkExpirationExceptionInterface
{
    /**
     * @return array
     */
    public function getExpirationErrors(): array;
}