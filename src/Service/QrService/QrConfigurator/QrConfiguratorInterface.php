<?php

namespace App\Service\QrService\QrConfigurator;


use Endroid\QrCode\Writer\PngWriter;

interface QrConfiguratorInterface
{
    public function pathConfigure(): String;
    public function imageConfigure(String $url, String $logoPath, PngWriter $writer): array;
}