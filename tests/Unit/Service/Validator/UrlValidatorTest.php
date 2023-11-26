<?php

namespace Unit\Service\Validator;

use App\Service\Validator\UrlValidator;
use App\Service\Validator\UrlValidatorInterface;
use App\Service\Validator\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class UrlValidatorTest
    extends TestCase
{
    private UrlValidatorInterface $urlValidator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->urlValidator = new UrlValidator();
    }

    public function testValidUrl()
    {
        $url = 'https://www.example.com';

        $result = $this->urlValidator->validateUrl($url);

        $this->assertTrue($result, 'Validation should pass for a valid URL');
    }

    public function testInvalidUrlFormat()
    {
        $url = 'invalid-url-format';

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Validation failed.');

        $this->urlValidator->validateUrl($url);
    }

    public function testInvalidUrlScheme()
    {
        $url = 'ftp://www.example.com';

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Validation failed.');

        $this->urlValidator->validateUrl($url);
    }

    public function testInvalidUrlStructure()
    {
        $url = 'www.example.com';

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Validation failed.');

        $this->urlValidator->validateUrl($url);
    }
}
