<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
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
    private $dateLocation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeLocation;

    /**
     * @ORM\Column(type="integer")
     */
    private $montantLocation;

    /**
     * @ORM\Column(type="integer")
     */
    private $caution;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etatLocation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Locataire", inversedBy="locations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $locataire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paiement", mappedBy="location")
     */
    private $paiements;

    public function __construct()
    {
        $this->paiements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLocation(): ?\DateTimeInterface
    {
        return $this->dateLocation;
    }

    public function setDateLocation(\DateTimeInterface $dateLocation): self
    {
        $this->dateLocation = $dateLocation;

        return $this;
    }

    public function getTypeLocation(): ?string
    {
        return $this->typeLocation;
    }

    public function setTypeLocation(string $typeLocation): self
    {
        $this->typeLocation = $typeLocation;

        return $this;
    }

    public function getMontantLocation(): ?int
    {
        return $this->montantLocation;
    }

    public function setMontantLocation(int $montantLocation): self
    {
        $this->montantLocation = $montantLocation;

        return $this;
    }

    public function getCaution(): ?int
    {
        return $this->caution;
    }

    public function setCaution(int $caution): self
    {
        $this->caution = $caution;

        return $this;
    }

    public function getEtatLocation(): ?string
    {
        return $this->etatLocation;
    }

    public function setEtatLocation(string $etatLocation): self
    {
        $this->etatLocation = $etatLocation;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): self
    {
        $this->locataire = $locataire;

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
            $paiement->setLocation($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->contains($paiement)) {
            $this->paiements->removeElement($paiement);
            // set the owning side to null (unless already changed)
            if ($paiement->getLocation() === $this) {
                $paiement->setLocation(null);
            }
        }

        return $this;
    }
}
