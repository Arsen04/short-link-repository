<?php

namespace App\Entity;

use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShortLinkRepositoryImpl::class)]
class ShortLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?String $baseUrl = null;

    #[ORM\Column(name: "short_url", length: 255)]
    private ?String $shortUrl = null;

    #[ORM\Column(name: "url_path", length: 255)]
    private ?String $urlPath = null;

    #[ORM\Column(nullable: true)]
    private ?int $redirectCount = 0;

    #[ORM\Column(length: 255)]
    private ?String $websiteHost = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?String $qrCode = null;

    #[ORM\Column]
    private ?float $lifeTime = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleted_at = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return String|null
     */
    public function getBaseUrl(): ?String
    {
        return $this->baseUrl;
    }

    /**
     * @param String $baseUrl
     * @return $this
     */
    public function setBaseUrl(String $baseUrl): static
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * @return String|null
     */
    public function getShortUrl(): ?String
    {
        return $this->shortUrl;
    }

    /**
     * @param String $shortUrl
     * @return $this
     */
    public function setShortUrl(String $shortUrl): static
    {
        $this->shortUrl = $shortUrl;

        return $this;
    }

    /**
     * @return String|null
     */
    public function getUrlPath(): ?String
    {
        return $this->urlPath;
    }

    /**
     * @param String|null $urlPath
     */
    public function setUrlPath(?String $urlPath): void
    {
        $this->urlPath = $urlPath;
    }

    /**
     * @return int|null
     */
    public function getRedirectCount(): ?int
    {
        return $this->redirectCount;
    }

    /**
     * @param int|null $redirectCount
     * @return $this
     */
    public function setRedirectCount(?int $redirectCount): static
    {
        $this->redirectCount = $redirectCount;

        return $this;
    }

    /**
     * @return String|null
     */
    public function getWebsiteHost(): ?String
    {
        return $this->websiteHost;
    }

    /**
     * @param String $websiteHost
     * @return $this
     */
    public function setWebsiteHost(String $websiteHost): static
    {
        $this->websiteHost = $websiteHost;

        return $this;
    }

    /**
     * @return String|null
     */
    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    /**
     * @param String|null $qrCode
     */
    public function setQrCode(?string $qrCode): void
    {
        $this->qrCode = $qrCode;
    }

    /**
     * @return float|null
     */
    public function getLifeTime(): ?float
    {
        return $this->lifeTime;
    }

    /**
     * @param float $lifeTime
     * @return $this
     */
    public function setLifeTime(float $lifeTime): static
    {
        $this->lifeTime = $lifeTime;

        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * @return void
     */
    public function setCreatedAt(): void
    {
        $created_at = new DateTimeImmutable();
        $this->created_at = $created_at;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTimeImmutable|null $updated_at
     */
    public function setUpdatedAt(?\DateTimeImmutable $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    /**
     * @param \DateTimeImmutable|null $deleted_at
     */
    public function setDeletedAt(?\DateTimeImmutable $deleted_at): void
    {
        $this->deleted_at = $deleted_at;
    }
}
