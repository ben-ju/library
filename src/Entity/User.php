<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Unique(message="This email is already used. Please connect")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $role = ['ROLE_USER'];

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $subscribed_at;

    /**
     * @ORM\Column(type="string")
     */
    private $phone_number;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $subscription_end_date;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('free', 'subscribed')", length=255, nullable=false)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=Penalty::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $penalty;

    /**
     * @ORM\OneToMany(targetEntity=Borrowing::class, mappedBy="user", orphanRemoval=true)
     */
    private $borrows;

    public function __construct()
    {
        $this->borrows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }


    public function getSalt()
    {
    }

    public function getUsername() :?string
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSubscribedAt(): ?\DateTimeInterface
    {
        return $this->subscribed_at;
    }

    public function setSubscribedAt(\DateTimeInterface $subscribed_at): self
    {
        $this->subscribed_at = $subscribed_at;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getSubscriptionEndDate(): ?\DateTimeInterface
    {
        return $this->subscription_end_date;
    }

    public function setSubscriptionEndDate(\DateTimeInterface $subscription_end_date): self
    {
        $this->subscription_end_date = $subscription_end_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPenalty(): ?Penalty
    {
        return $this->penalty;
    }

    public function setPenalty(?Penalty $penalty): self
    {
        $this->penalty = $penalty;

        return $this;
    }

    /**
     * @return Collection|Borrowing[]
     */
    public function getBorrows(): Collection
    {
        return $this->borrows;
    }

    public function addBorrow(Borrowing $borrow): self
    {
        if (!$this->borrows->contains($borrow)) {
            $this->borrows[] = $borrow;
            $borrow->setUser($this);
        }

        return $this;
    }

    public function removeBorrow(Borrowing $borrow): self
    {
        if ($this->borrows->contains($borrow)) {
            $this->borrows->removeElement($borrow);
            // set the owning side to null (unless already changed)
            if ($borrow->getUser() === $this) {
                $borrow->setUser(null);
            }
        }

        return $this;
    }
}
