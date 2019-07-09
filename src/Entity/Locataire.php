<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocataireRepository")
 */
class Locataire
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
    private $nomLocataire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomLocataire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $piecesFournis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeLocataire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Location", mappedBy="locataire")
     */
    private $locations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paiement", mappedBy="locataire")
     */
    private $paiements;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
        $this->paiements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLocataire(): ?string
    {
        return $this->nomLocataire;
    }

    public function setNomLocataire(string $nomLocataire): self
    {
        $this->nomLocataire = $nomLocataire;

        return $this;
    }

    public function getPrenomLocataire(): ?string
    {
        return $this->prenomLocataire;
    }

    public function setPrenomLocataire(string $prenomLocataire): self
    {
        $this->prenomLocataire = $prenomLocataire;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

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

    public function getPiecesFournis(): ?string
    {
        return $this->piecesFournis;
    }

    public function setPiecesFournis(string $piecesFournis): self
    {
        $this->piecesFournis = $piecesFournis;

        return $this;
    }

    public function getTypeLocataire(): ?string
    {
        return $this->typeLocataire;
    }

    public function setTypeLocataire(string $typeLocataire): self
    {
        $this->typeLocataire = $typeLocataire;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setLocataire($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->contains($location)) {
            $this->locations->removeElement($location);
            // set the owning side to null (unless already changed)
            if ($location->getLocataire() === $this) {
                $location->setLocataire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements[] = $paiement;
            $paiement->setLocataire($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->contains($paiement)) {
            $this->paiements->removeElement($paiement);
            // set the owning side to null (unless already changed)
            if ($paiement->getLocataire() === $this) {
                $paiement->setLocataire(null);
            }
        }

        return $this;
    }
}
