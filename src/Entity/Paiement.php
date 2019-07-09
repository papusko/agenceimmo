<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaiementRepository")
 */
class Paiement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDePaiement;

    /**
     * @ORM\Column(type="integer")
     */
    private $montantPaiement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\locataire", inversedBy="paiements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $locataire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\location", inversedBy="paiements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDePaiement(): ?\DateTimeInterface
    {
        return $this->dateDePaiement;
    }

    public function setDateDePaiement(\DateTimeInterface $dateDePaiement): self
    {
        $this->dateDePaiement = $dateDePaiement;

        return $this;
    }

    public function getMontantPaiement(): ?int
    {
        return $this->montantPaiement;
    }

    public function setMontantPaiement(int $montantPaiement): self
    {
        $this->montantPaiement = $montantPaiement;

        return $this;
    }

    public function getLocataire(): ?locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?locataire $locataire): self
    {
        $this->locataire = $locataire;

        return $this;
    }

    public function getLocation(): ?location
    {
        return $this->location;
    }

    public function setLocation(?location $location): self
    {
        $this->location = $location;

        return $this;
    }
}
