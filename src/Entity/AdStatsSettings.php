<?php

namespace App\Entity;

use App\Repository\AdStatsSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdStatsSettingsRepository::class)
 */
class AdStatsSettings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $currency;

    /**
     * @ORM\Column(type="integer")
     */
    private $period_length;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getPeriodLength(): ?int
    {
        return $this->period_length;
    }

    public function setPeriodLength(int $period_length): self
    {
        $this->period_length = $period_length;

        return $this;
    }
}
