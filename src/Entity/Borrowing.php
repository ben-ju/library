<?php

namespace App\Entity;

use App\Repository\BorrowingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BorrowingRepository::class)
 */
class Borrowing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $borrowed_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expected_return_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $actual_return_date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="borrows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="borrowings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $document;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowedAt(): ?\DateTimeInterface
    {
        return $this->borrowed_at;
    }

    public function setBorrowedAt(\DateTimeInterface $borrowed_at): self
    {
        $this->borrowed_at = $borrowed_at;

        return $this;
    }

    public function getExpectedReturnDate(): ?\DateTimeInterface
    {
        return $this->expected_return_date;
    }

    public function setExpectedReturnDate(\DateTimeInterface $expected_return_date): self
    {
        $this->expected_return_date = $expected_return_date;

        return $this;
    }

    public function getActualReturnDate(): ?\DateTimeInterface
    {
        return $this->actual_return_date;
    }

    public function setActualReturnDate(?\DateTimeInterface $actual_return_date): self
    {
        $this->actual_return_date = $actual_return_date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }
}
