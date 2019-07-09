<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgentRepository")
 */
class Agent
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
    private $nomAgent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomAgent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseAgent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgent(): ?string
    {
        return $this->nomAgent;
    }

    public function setNomAgent(string $nomAgent): self
    {
        $this->nomAgent = $nomAgent;

        return $this;
    }

    public function getPrenomAgent(): ?string
    {
        return $this->prenomAgent;
    }

    public function setPrenomAgent(string $prenomAgent): self
    {
        $this->prenomAgent = $prenomAgent;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresseAgent(): ?string
    {
        return $this->adresseAgent;
    }

    public function setAdresseAgent(string $adresseAgent): self
    {
        $this->adresseAgent = $adresseAgent;

        return $this;
    }
}
