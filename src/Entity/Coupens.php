<?php

namespace App\Entity;

use App\Repository\CoupensRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoupensRepository::class)
 */
class Coupens
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $coupen;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_available;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoupen(): ?string
    {
        return $this->coupen;
    }

    public function setCoupen(string $coupen): self
    {
        $this->coupen = $coupen;

        return $this;
    }

    public function getIsAvailable(): ?bool
    {
        return $this->is_available;
    }

    public function setIsAvailable(bool $is_available): self
    {
        $this->is_available = $is_available;

        return $this;
    }
}
