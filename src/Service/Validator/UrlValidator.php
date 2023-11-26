<?php

namespace App\Service\Validator;

use App\Service\Validator\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UrlValidator
    implements UrlValidatorInterface
{
    /**
     * @param String $url
     * @return bool
     * @throws ValidationException
     */
    public function validateUrl(String $url): bool
    {
        if (!preg_match("~^https?://~i", $url)) {
            $validationErrors = ['url' => 'Invalid URL format.'];
            throw new ValidationException('Validation failed.', Response::HTTP_BAD_REQUEST, $validationErrors);
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $validationErrors = ['url' => 'Invalid URL format.'];
            throw new ValidationException('Validation failed.', Response::HTTP_BAD_REQUEST, $validationErrors);
        }

        if (!preg_match("/^(http(s)?:\/\/)?(www\.)?.+\..+$/i", $url)) {
            $validationErrors = ['url' => 'Invalid URL format.'];
            throw new ValidationException('Validation failed.', Response::HTTP_BAD_REQUEST, $validationErrors);
        }

        return true;
    }
}
