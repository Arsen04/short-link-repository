<?php

namespace App\Service\Validator\Exception;

use Exception;
use Throwable;

class ValidationException extends Exception implements ValidationExceptionInterface
{
    protected array $validationErrors;

    /**
     * @param string $message
     * @param int $code
     * @param array $validationErrors
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, $validationErrors = [], Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->validationErrors = $validationErrors;
    }

    /**
     * @return array
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}