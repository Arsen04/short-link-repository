<?php

namespace App\Service\Validator\Exception;

interface ValidationExceptionInterface
{
    /**
     * @return array
     */
    public function getValidationErrors(): array;
}