<?php

namespace App\Service\LinkService\LinkExpirationChecker\Exception;

use Exception;
use Throwable;

class LinkExpirationException
    extends Exception
    implements LinkExpirationExceptionInterface
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
    public function getExpirationErrors(): array
    {
        return $this->existenceErrors;
    }
}