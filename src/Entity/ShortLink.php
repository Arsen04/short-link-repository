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
    private ?string $baseUrl = null;

    #[ORM\Column(name: "short_url", length: 255)]
    private ?string $shortUrl = null;

    #[ORM\Column(nullable: true)]
    private ?int $redirectCount = 0;

    #[ORM\Column(length: 255)]
    private ?string $websiteHost = null;

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
     * @return string|null
     */
    public function getBaseUrl(): ?string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     * @return $this
     */
    public function setBaseUrl(string $baseUrl): static
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShortUrl(): ?string
    {
        return $this->shortUrl;
    }

    /**
     * @param string $shortUrl
     * @return $this
     */
    public function setShortUrl(string $shortUrl): static
    {
        $this->shortUrl = $shortUrl;

        return $this;
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
     * @return string|null
     */
    public function getWebsiteHost(): ?string
    {
        return $this->websiteHost;
    }

    /**
     * @param string $websiteHost
     * @return $this
     */
    public function setWebsiteHost(string $websiteHost): static
    {
        $this->websiteHost = $websiteHost;

        return $this;
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
