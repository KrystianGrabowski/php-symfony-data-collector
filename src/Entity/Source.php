<?php

namespace App\Entity;

use App\Repository\SourceRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=SourceRepository::class)
 */
class Source implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $url;

    public function getUrl(): ?string
    {
        return $this->url;
    }
    
    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'url' => $this->url
        );
    }
}
