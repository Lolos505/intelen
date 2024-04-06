<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
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
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearOfPublication;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $isbnCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $publisher;

    /**
     * @ORM\OneToMany(targetEntity=BookAuthor::class, mappedBy="book")
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getYearOfPublication(): ?int
    {
        return $this->yearOfPublication;
    }

    public function setYearOfPublication(int $yearOfPublication): self
    {
        $this->yearOfPublication = $yearOfPublication;

        return $this;
    }

    public function getIsbnCode(): ?string
    {
        return $this->isbnCode;
    }

    public function setIsbnCode(string $isbnCode): self
    {
        $this->isbnCode = $isbnCode;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): self
    {
        $this->publisher = $publisher;

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
            $bookAuthor->setBook($this);
        }

        return $this;
    }

    public function removeBookAuthor(BookAuthor $bookAuthor): self
    {
        if ($this->bookAuthors->removeElement($bookAuthor)) {
            // set the owning side to null (unless already changed)
            if ($bookAuthor->getBook() === $this) {
                $bookAuthor->setBook(null);
            }
        }

        return $this;
    }
}
