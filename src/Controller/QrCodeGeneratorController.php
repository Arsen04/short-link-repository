<?php

namespace App\Controller;

use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;
use App\Service\LinkService\LinkExistenceChecker\Exception\LinkExistenceException;
use App\Service\LinkService\LinkExpirationChecker\Exception\LinkExpirationException;
use App\Service\LinkService\LinkExpirationChecker\LinkExpirationChecker;
use App\Service\QrService\QrConfigurator\QrConfigurator;
use PHPUnit\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeGeneratorController
    extends AbstractController
{
    /**
     * @var PngWriter
     */
    protected PngWriter $writer;

    /**
     * @var QrConfigurator
     */
    protected QrConfigurator $configurator;

    /**
     * @var ShortLinkRepositoryImpl
     */
    protected ShortLinkRepositoryImpl $shortLinkRepository;

    /**
     * @var LinkExpirationChecker
     */
    protected LinkExpirationChecker $expirationChecker;

    /**
     * @var ShortLinkRepositoryImpl
     */
    protected ShortLinkRepositoryImpl $linkRepositoryImpl;

    /**
     * @var String
     */
    protected String $folder_path;

    /**
     * @param QrConfigurator $configurator
     * @param PngWriter $writer
     * @param ShortLinkRepositoryImpl $shortLinkRepository
     * @param LinkExpirationChecker $expirationChecker
     * @param ShortLinkRepositoryImpl $linkRepositoryImpl
     * @param String $folder_path
     */
    public function __construct(
        QrConfigurator $configurator,
        PngWriter $writer,
        ShortLinkRepositoryImpl $shortLinkRepository,
        LinkExpirationChecker $expirationChecker,
        ShortLinkRepositoryImpl $linkRepositoryImpl,
        String $folder_path,
    )
    {
        $this->configurator = $configurator;
        $this->writer = $writer;
        $this->shortLinkRepository = $shortLinkRepository;
        $this->expirationChecker = $expirationChecker;
        $this->linkRepositoryImpl = $linkRepositoryImpl;
        $this->folder_path = $folder_path;
    }

    /**
     * @throws LinkExpirationException
     * @throws LinkExistenceException
     */
    #[Route(
        path: '/qr-code-generator/{token}',
        name: 'app_qr_codes',
        methods: Request::METHOD_GET
    )]
    public function QrCodeGenerator(Request $request): JsonResponse
    {
        $token = $request->attributes->get('token');
        $linkExists = $this->shortLinkRepository->findOneBy(["shortUrl" => $token]);

        if (!$linkExists) {
            throw new LinkExistenceException('Link does not exist for token: ' . $token);
        }
        $this->expirationChecker->linkExpired($linkExists);

        $filePath = $this->folder_path . $linkExists->getQrCode();
        $filePath = str_replace('\\', '/', $filePath);

        if(
            file_exists($filePath) &&
            !is_null($linkExists->getQrCode())
        ) {
            return $this->json([
                'code' => Response::HTTP_OK,
                'status' => "Success",
                'message' => "QR code already exists",
                'qrFileName' => $linkExists->getQrCode()
            ]);
        }

        $realUrl = $linkExists->getBaseUrl();
        $logoPath = $this->configurator->pathConfigure();
        $fileName = basename($logoPath);
        $qrCodes = $this->configurator->imageConfigure($realUrl, $logoPath, $this->writer);
        $encodedContent = substr($qrCodes["simple"], strpos($qrCodes["simple"], ',') + 1);

        try {
            $binaryData = base64_decode($encodedContent);
            file_put_contents($logoPath, $binaryData);

            $linkExists->setQrCode($fileName);
            $this->linkRepositoryImpl->save($linkExists);

            $code = Response::HTTP_CREATED;
            $status = "Success";
            $message = "QR code created successfully";
        } catch (Exception $e) {
            $code = Response::HTTP_BAD_GATEWAY;
            $status = "Failed";
            $message = "Can't create QR code";
        }

        return $this->json([
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'qrFileName' => $fileName
        ]);
    }
}
