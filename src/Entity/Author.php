<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearOfBirth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $countryOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=BookAuthor::class, mappedBy="author")
     */
    private $bookAuthors;

    public function __construct()
    {
        $this->bookAuthors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getYearOfBirth(): ?int
    {
        return $this->yearOfBirth;
    }

    public function setYearOfBirth(int $yearOfBirth): self
    {
        $this->yearOfBirth = $yearOfBirth;

        return $this;
    }

    public function getCountryOfBirth(): ?string
    {
        return $this->countryOfBirth;
    }

    public function setCountryOfBirth(string $countryOfBirth): self
    {
        $this->countryOfBirth = $countryOfBirth;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

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

    /**
     * @return Collection|BookAuthor[]
     */
    public function getBookAuthors(): Collection
    {
        return $this->bookAuthors;
    }

    public function addBookAuthor(BookAuthor $bookAuthor): self
    {
        if (!$this->bookAuthors->contains($bookAuthor)) {
            $this->bookAuthors[] = $bookAuthor;
            $bookAuthor->setAuthor($this);
        }

        return $this;
    }

    public function removeBookAuthor(BookAuthor $bookAuthor): self
    {
        if ($this->bookAuthors->removeElement($bookAuthor)) {
            // set the owning side to null (unless already changed)
            if ($bookAuthor->getAuthor() === $this) {
                $bookAuthor->setAuthor(null);
            }
        }

        return $this;
    }
}
