<?php

namespace App\Entity;

use App\Repository\DvdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DvdRepository::class)
 */
class Dvd extends Document
{
    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="boolean")
     */
    private $has_bonus;

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getHasBonus(): ?bool
    {
        return $this->has_bonus;
    }

    public function setHasBonus(bool $has_bonus): self
    {
        $this->has_bonus = $has_bonus;

        return $this;
    }

    public function __toString() :string
    {
        return $this->getTitle();
    }

}
