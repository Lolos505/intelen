<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookAuthorRepository")
 */
class BookAuthor
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="bookAuthors")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id", nullable=false)
     */
    private $book;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="bookAuthors")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    private $author;

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }
}
