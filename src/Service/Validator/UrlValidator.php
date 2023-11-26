<?php

namespace App\Service\Validator;

use App\Service\Validator\Exception\ValidationException;

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
            throw new ValidationException('Validation failed.', 400, $validationErrors);
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $validationErrors = ['url' => 'Invalid URL format.'];
            throw new ValidationException('Validation failed.', 400, $validationErrors);
        }

        if (!preg_match("/^(http(s)?:\/\/)?(www\.)?.+\..+$/i", $url)) {
            $validationErrors = ['url' => 'Invalid URL format.'];
            throw new ValidationException('Validation failed.', 400, $validationErrors);
        }

        return true;
    }
}
