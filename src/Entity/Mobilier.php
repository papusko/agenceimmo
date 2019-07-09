<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MobilierRepository")
 * @UniqueEntity("titre")
 *@Vich\Uploadable()
 */
class Mobilier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
    * @var string|null
    * @ORM\Column(type="string", length=255)
    */
    private $filename;
    /**
    * @var File|null
    * @Vich\UploadableField(mapping="product_image", fileNameProperty="filename")
    */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 180,
     *      minMessage = "Vous devez avoir au moins une pièces pour chaque mobilier. ",
     *      maxMessage = "Vous ne pouvez pas dépasser 180 pour chauqe mobilier"
     * )
     */
    private $pieces;

    /**
     * @ORM\Column(type="integer")
      * @Assert\Range(
     *      min = 1,
     *      max = 800,
     *      minMessage = "Vous devez avoir au moins une chambre pour chaque mobilier. ",
     *      maxMessage = "Vous ne pouvez pas dépasser 180 chambres pour chauqe mobilier"
     * )
     */
    private $chambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $etage;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $solde;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_at;


    public function __construct()
    {
        $this->creation_at = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPieces(): ?int
    {
        return $this->pieces;
    }

    public function setPieces(int $pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    public function getChambre(): ?int
    {
        return $this->chambre;
    }

    public function setChambre(int $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSolde(): ?bool
    {
        return $this->solde;
    }

    public function setSolde(bool $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getCreationAt(): ?\DateTimeInterface
    {
        return $this->creation_at;
    }

    public function setCreationAt(\DateTimeInterface $creation_at): self
    {
        $this->creation_at = new \DateTime('now');

        return $this;
    }

    /**
    *@return null|string
    */
    public function getFilename(): ?string
    {
        return $this->filename;
    } 

    /**
    *@param null\string $filename
    *@return Mobilier
    */
    public function setFilename(?string $filename): Mobilier
    {
        $this->filename=$filename;
        return $this;
    }

    /**
    *@return null|File
    */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
    * @param null|File $imageFile
    *@return Mobilier
    */
    public function setImageFile(?File $imageFile): Mobilier
    {
        $this->imageFile=$imageFile;
        if($this->imageFile instanceof UplodedFile)
        {
            $this->creation_at = new \DateTime('now');
        }
        return $this;
    }



}
