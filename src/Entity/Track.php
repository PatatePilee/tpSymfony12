<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TrackRepository; 

#[ORM\Entity(repositoryClass: TrackRepository::class)]
class Track
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private int $discNumber;

    #[ORM\Column(type: "integer")]
    private int $durationMs;

    #[ORM\Column(type: "boolean")]
    private bool $explicit;

    #[ORM\Column(type: "string", length: 255)]
    private string $isrc;

    #[ORM\Column(type: "string", length: 255)]
    private string $spotifyUrl;

    #[ORM\Column(type: "string", length: 255)]
    private string $href;

    #[ORM\Column(type: "string", length: 255)]
    private string $spotifyId;

    #[ORM\Column(type: "boolean")]
    private bool $isLocal;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "integer")]
    private int $popularity;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $previewUrl;

    #[ORM\Column(type: "integer")]
    private int $trackNumber;

    #[ORM\Column(type: "string", length: 255)]
    private string $type;

    #[ORM\Column(type: "string", length: 255)]
    private string $uri;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $pictureLink;

    public function __construct(
        int $discNumber,
        int $durationMs,
        bool $explicit,
        string $isrc,
        string $spotifyUrl,
        string $href,
        string $spotifyId,
        bool $isLocal,
        string $name,
        int $popularity,
        ?string $previewUrl,
        int $trackNumber,
        string $type,
        string $uri,
        ?string $pictureLink
    ) {
        $this->discNumber = $discNumber;
        $this->durationMs = $durationMs;
        $this->explicit = $explicit;
        $this->isrc = $isrc;
        $this->spotifyUrl = $spotifyUrl;
        $this->href = $href;
        $this->spotifyId = $spotifyId;
        $this->isLocal = $isLocal;
        $this->name = $name;
        $this->popularity = $popularity;
        $this->previewUrl = $previewUrl;
        $this->trackNumber = $trackNumber;
        $this->type = $type;
        $this->uri = $uri;
        $this->pictureLink = $pictureLink;
    }

    // Getters and setters for each property

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscNumber(): int
    {
        return $this->discNumber;
    }

    public function setDiscNumber(int $discNumber): self
    {
        $this->discNumber = $discNumber;
        return $this;
    }

    public function getDurationMs(): int
    {
        return $this->durationMs;
    }

    public function setDurationMs(int $durationMs): self
    {
        $this->durationMs = $durationMs;
        return $this;
    }

    public function isExplicit(): bool
    {
        return $this->explicit;
    }

    public function setExplicit(bool $explicit): self
    {
        $this->explicit = $explicit;
        return $this;
    }

    public function getIsrc(): string
    {
        return $this->isrc;
    }

    public function setIsrc(string $isrc): self
    {
        $this->isrc = $isrc;
        return $this;
    }

    public function getSpotifyUrl(): string
    {
        return $this->spotifyUrl;
    }

    public function setSpotifyUrl(string $spotifyUrl): self
    {
        $this->spotifyUrl = $spotifyUrl;
        return $this;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
    }

    public function getSpotifyId(): string
    {
        return $this->spotifyId;
    }

    public function setSpotifyId(string $spotifyId): self
    {
        $this->spotifyId = $spotifyId;
        return $this;
    }

    public function isLocal(): bool
    {
        return $this->isLocal;
    }

    public function setIsLocal(bool $isLocal): self
    {
        $this->isLocal = $isLocal;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPopularity(): int
    {
        return $this->popularity;
    }

    public function setPopularity(int $popularity): self
    {
        $this->popularity = $popularity;
        return $this;
    }

    public function getPreviewUrl(): ?string
    {
        return $this->previewUrl;
    }

    public function setPreviewUrl(?string $previewUrl): self
    {
        $this->previewUrl = $previewUrl;
        return $this;
    }

    public function getTrackNumber(): int
    {
        return $this->trackNumber;
    }

    public function setTrackNumber(int $trackNumber): self
    {
        $this->trackNumber = $trackNumber;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;
        return $this;
    }

    public function getPictureLink(): ?string
    {
        return $this->pictureLink;
    }

    public function setPictureLink(?string $pictureLink): self
    {
        $this->pictureLink = $pictureLink;
        return $this;
    }
}
