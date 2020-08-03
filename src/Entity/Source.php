<?php

namespace App\Entity;

use App\Repository\SourceRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use JsonSerializable;
use Exception;

/**
 * @ORM\Entity(repositoryClass=SourceRepository::class)
 * @ORM\Table(name="source",uniqueConstraints={@UniqueConstraint(name="source_constraint", columns={"url"})})
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

    public function setId($id): ?self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $url;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl($url): self
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $this->url = $url;
        }
        else
        {
            throw new Exception("Invalid URL");
        }
        
        return $this;
    }
    
    /**
     * @ORM\Column(type="boolean", options={"default" : true})
     */
    private $is_active = true;

    public function getIsActive(): ?string
    {
        return $this->is_active;
    }

    public function setIsActive($is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }
    
    public function jsonSerialize()
    {
        return array(
            'id' => $this->getId(),
            'url' => $this->getUrl(),
            'is_active' => $this->getIsActive() ? true : false
        );
    }
}
