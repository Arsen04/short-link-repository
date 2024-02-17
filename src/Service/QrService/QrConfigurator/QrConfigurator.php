<?php

namespace App\Service\QrService\QrConfigurator;

use App\Enum\QrFormatEnum;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrConfigurator
    implements QrConfiguratorInterface
{
    /**
     * @var String
     */
    protected String $folder_path;

    public function __construct(String $folder_path)
    {
        $this->folder_path = $folder_path;
    }

    /**
     * @return String
     * @throws \Exception
     */
    public function pathConfigure(): String
    {
        $basePath = $this->folder_path;
        $width = 100;
        $height = 100;

        $nameGenerating = "QR-" . bin2hex(random_bytes(8));
        $logoPath = $basePath . $nameGenerating . QrFormatEnum::PNG->value;

        $image = imagecreatetruecolor($width, $height);
        $transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);

        imagefill($image, 0, 0, $transparentColor);
        imagepng($image, $logoPath);
        imagedestroy($image);

        return $logoPath;
    }

    /**
     * @param String $url
     * @param String $logoPath
     * @param PngWriter $writer
     * @return array
     */
    public function imageConfigure(
        String $url,
        String $logoPath,
        PngWriter $writer
    ): array
    {
        $qrCode = QrCode::create($url)
            ->setEncoding(new Encoding('UTF-8'))
            ->setSize(500)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $logo = Logo::create($logoPath)
            ->setResizeToWidth(60);
        $label = Label::create('')->setFont(new NotoSans(8));

        $qrCodes = [];
        $qrCodes['img'] = $writer->write($qrCode, $logo)->getDataUri();
        $qrCodes['simple'] = $writer->write(
            $qrCode,
            null,
            $label->setText('Your QR')
        )->getDataUri();

        return $qrCodes;
    }
}
