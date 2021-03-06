<?php

namespace App\Entity;

use App\Repository\AdStatsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=AdStatsRepository::class)
 * @ORM\Table(name="ad_stats",uniqueConstraints={@UniqueConstraint(name="ad_stats_constraint", columns={"url", "tags" ,"date"})})
 */
class AdStats implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $estimated_revenue;

    /**
     * @ORM\Column(type="integer")
     */
    private $ad_impressions;

    /**
     * @ORM\Column(type="float")
     */
    private $ad_ecpm;

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $clicks;

    /**
     * @ORM\Column(type="float")
     */
    private $ad_ctr;

    /**
     * @ORM\Column(type="integer")
     */
    private $ad_settings_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $source_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEstimatedRevenue(): ?float
    {
        return $this->estimated_revenue;
    }

    public function setEstimatedRevenue(float $estimated_revenue): self
    {
        $this->estimated_revenue = $estimated_revenue;

        return $this;
    }

    public function getAdImpressions(): ?int
    {
        return $this->ad_impressions;
    }

    public function setAdImpressions(int $ad_impressions): self
    {
        $this->ad_impressions = $ad_impressions;

        return $this;
    }

    public function getAdEcpm(): ?float
    {
        return $this->ad_ecpm;
    }

    public function setAdEcpm(float $ad_ecpm): self
    {
        $this->ad_ecpm = $ad_ecpm;

        return $this;
    }

    public function getClicks(): ?int
    {
        return $this->clicks;
    }

    public function setClicks(int $clicks): self
    {
        $this->clicks = $clicks;

        return $this;
    }

    public function getAdCtr(): ?float
    {
        return $this->ad_ctr;
    }

    public function setAdCtr(float $ad_ctr): self
    {
        $this->ad_ctr = $ad_ctr;

        return $this;
    }

    public function getAdSettingsId(): ?int
    {
        return $this->ad_settings_id;
    }

    public function setAdSettingsId(int $ad_settings_id): self
    {
        $this->ad_settings_id = $ad_settings_id;

        return $this;
    }

    public function getSourceId(): ?int
    {
        return $this->ad_settings_id;
    }

    public function setSourceId(int $source_id): self
    {
        $this->source_id = $source_id;

        return $this;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->getId(),
            'url' => $this->getUrl(),
            'tags' => $this->getTags(),
            'date' => $this->getDate(),
            'estimatedRevenue' => $this->getEstimatedRevenue(),
            'adImpressions' => $this->getAdImpressions(),
            'adEcpm' => $this->getAdEcpm(),
            'clicks' => $this->getClicks(),
            'adCtr' => $this->getAdCtr(),
            'adSettingsId' => $this->getAdSettingsId(),
            'source_id' => $this->getSourceId()
        );
    }
}
