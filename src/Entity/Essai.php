<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EssaiRepository")
 */
class Essai
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $espece;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEspece(): ?bool
    {
        return $this->espece;
    }

    public function setEspece(bool $espece): self
    {
        $this->espece = $espece;

        return $this;
    }
}
