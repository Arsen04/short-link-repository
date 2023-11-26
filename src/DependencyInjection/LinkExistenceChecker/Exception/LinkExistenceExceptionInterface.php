<?php

namespace App\DependencyInjection\LinkExistenceChecker\Exception;

interface LinkExistenceExceptionInterface
{
    /**
     * @return array
     */
    public function getExistenceErrors(): array;
}