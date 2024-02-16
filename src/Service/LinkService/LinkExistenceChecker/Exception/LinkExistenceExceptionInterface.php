<?php

namespace App\Service\LinkService\LinkExistenceChecker\Exception;

interface LinkExistenceExceptionInterface
{
    /**
     * @return array
     */
    public function getExistenceErrors(): array;
}