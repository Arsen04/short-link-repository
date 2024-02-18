<?php

namespace App\Service\Validator\Exception;

use Exception;
use Throwable;

class ValidationException
    extends Exception
    implements ValidationExceptionInterface
{
    /**
     * @var array
     */
    protected array $validationErrors;

    /**
     * @param string $message
     * @param int $code
     * @param array $validationErrors
     * @param Throwable|null $previous
     */
    public function __construct(
        String $message = "",
        int $code = 0,
        array $validationErrors = [],
        Throwable $previous = null
    )
    {
        parent::__construct(
            $message,
            $code,
            $previous
        );
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