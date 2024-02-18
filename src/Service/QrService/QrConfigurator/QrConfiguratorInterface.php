<?php

namespace App\Service\QrService\QrConfigurator;


use Endroid\QrCode\Writer\PngWriter;

interface QrConfiguratorInterface
{
    /**
     * @return String
     */
    public function pathConfigure(): String;

    /**
     * @param String $url
     * @param String $logoPath
     * @param PngWriter $writer
     * @return array
     */
    public function imageConfigure(String $url, String $logoPath, PngWriter $writer): array;
}