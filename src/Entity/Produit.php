<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proLibelle;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $proDescription;

    /**
     * @ORM\Column(type="float")
     */
    private $prixHT;

    /**
     * @ORM\Column(type="float")
     */
    private $TVA;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTTC;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $proPhoto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $proStock;

    /**
     * @ORM\ManyToOne(targetEntity=Souscategories::class, inversedBy="produits")
     */
    private $sousCat;

    /**
     * @ORM\OneToMany(targetEntity=Lignedecommande::class, mappedBy="pro")
     */
    private $lignedecommandes;

    public function __construct()
    {
        $this->lignedecommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProLibelle(): ?string
    {
        return $this->proLibelle;
    }

    public function setProLibelle(string $proLibelle): self
    {
        $this->proLibelle = $proLibelle;

        return $this;
    }

    public function getProDescription(): ?string
    {
        return $this->proDescription;
    }

    public function setProDescription(string $proDescription): self
    {
        $this->proDescription = $proDescription;

        return $this;
    }

    public function getPrixHT(): ?float
    {
        return $this->prixHT;
    }

    public function setPrixHT(float $prixHT): self
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    public function getTVA(): ?float
    {
        return $this->TVA;
    }

    public function setTVA(float $TVA): self
    {
        $this->TVA = $TVA;

        return $this;
    }

    public function getPrixTTC(): ?float
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(float $prixTTC): self
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }

    public function getProPhoto(): ?string
    {
        return $this->proPhoto;
    }

    public function setProPhoto(string $proPhoto): self
    {
        $this->proPhoto = $proPhoto;

        return $this;
    }

    public function getProStock(): ?int
    {
        return $this->proStock;
    }

    public function setProStock(?int $proStock): self
    {
        $this->proStock = $proStock;

        return $this;
    }

    public function getSousCat(): ?Souscategories
    {
        return $this->sousCat;
    }

    public function setSousCat(?Souscategories $sousCat): self
    {
        $this->sousCat = $sousCat;

        return $this;
    }

    /**
     * @return Collection<int, Lignedecommande>
     */
    public function getLignedecommandes(): Collection
    {
        return $this->lignedecommandes;
    }

    public function addLignedecommande(Lignedecommande $lignedecommande): self
    {
        if (!$this->lignedecommandes->contains($lignedecommande)) {
            $this->lignedecommandes[] = $lignedecommande;
            $lignedecommande->setPro($this);
        }

        return $this;
    }

    public function removeLignedecommande(Lignedecommande $lignedecommande): self
    {
        if ($this->lignedecommandes->removeElement($lignedecommande)) {
            // set the owning side to null (unless already changed)
            if ($lignedecommande->getPro() === $this) {
                $lignedecommande->setPro(null);
            }
        }

        return $this;
    }
}
