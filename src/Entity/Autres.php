<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AutresRepository")
 */
class Autres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $essaie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEssaie(): ?string
    {
        return $this->essaie;
    }

    public function setEssaie(string $essaie): self
    {
        $this->essaie = $essaie;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
}
