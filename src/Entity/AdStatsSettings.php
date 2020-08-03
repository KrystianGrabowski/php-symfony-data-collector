<?php

namespace App\Entity;

use App\Repository\AdStatsSettingsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=AdStatsSettingsRepository::class)
 * @ORM\Table(name="ad_stats_settings",uniqueConstraints={@UniqueConstraint(name="ad_stats_settings_constraint", columns={"currency" ,"period_length"})})
 */
class AdStatsSettings implements JsonSerializable
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

    /**
     * @ORM\Column(type="string")
     */
    private $group_by;

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

    public function getGroupBy(): ?string
    {
        return $this->group_by;
    }

    public function setGroupBy($group_by): self
    {
        $this->group_by = $group_by;

        return $this;
    }


    public function jsonSerialize()
    {
        return array(
            'id' => $this->getId(),
            'currency' => $this->getCurrency(),
            'period_length' => $this->getPeriodLength(),
            'group_by' => $this->getGroupBy()
        );
    }
}
