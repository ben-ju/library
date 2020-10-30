<?php

namespace App\Entity;

use App\Repository\CdRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CdRepository::class)
 */
class Cd extends Document
{
    /**
     * @ORM\Column(type="integer")
     */
    private $total_duration;

    /**
     * @ORM\OneToMany(targetEntity=Plage::class, mappedBy="cd", orphanRemoval=true)
     */
    private $plages;

    public function __construct()
    {
        parent::__construct();
        $this->plages = new ArrayCollection();
    }

    public function getTotalDuration(): ?int
    {
        return $this->total_duration;
    }

    public function setTotalDuration(int $total_duration): self
    {
        $this->total_duration = $total_duration;

        return $this;
    }

    public function getId(): ?int
    {
        return parent::getId();
    }

    /**
     * @return Collection|Plage[]
     */
    public function getPlages(): Collection
    {
        return $this->plages;
    }

    public function addPlage(Plage $plage): self
    {
        if (!$this->plages->contains($plage)) {
            $this->plages[] = $plage;
            $plage->setCd($this);
        }

        return $this;
    }

    public function removePlage(Plage $plage): self
    {
        if ($this->plages->contains($plage)) {
            $this->plages->removeElement($plage);
            // set the owning side to null (unless already changed)
            if ($plage->getCd() === $this) {
                $plage->setCd(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }


}
