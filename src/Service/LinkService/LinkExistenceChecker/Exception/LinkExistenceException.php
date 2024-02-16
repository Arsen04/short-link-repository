<?php

namespace App\Service\LinkService\LinkExistenceChecker\Exception;

use Exception;
use Throwable;

class LinkExistenceException
    extends Exception
    implements LinkExistenceExceptionInterface
{
    protected array $existenceErrors;

    /**
     * @param string $message
     * @param int $code
     * @param array $existenceErrors
     * @param Throwable|null $previous
     */
    public function __construct(
        String $message = "",
        int $code = 0,
        array $existenceErrors = [],
        Throwable $previous = null
    )
    {
        parent::__construct(
            $message,
            $code,
            $previous
        );
        $this->existenceErrors = $existenceErrors;
    }

    /**
     * @return array
     */
    public function getExistenceErrors(): array
    {
        return $this->existenceErrors;
    }
}