<?php

namespace App\Entity;

use App\Repository\FictionBooksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FictionBooksRepository::class)
 */
class FictionBooks extends Book
{
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $bookType;

    public function getBookType(): ?string
    {
        return $this->bookType;
    }

    public function setBookType(?string $bookType): self
    {
        $this->bookType = $bookType;

        return $this;
    }
}
