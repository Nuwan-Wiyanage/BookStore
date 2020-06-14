<?php

namespace App\Entity;

use App\Repository\ChildrenBooksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChildrenBooksRepository::class)
 */
class ChildrenBooks extends Book
{
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ageGroup;

    public function getAgeGroup(): ?string
    {
        return $this->ageGroup;
    }

    public function setAgeGroup(string $ageGroup): self
    {
        $this->ageGroup = $ageGroup;

        return $this;
    }
}
