<?php

namespace App\Entity;

use App\Repository\SouscategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SouscategoriesRepository::class)
 */
class Souscategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $sousCatNom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $sousCatPhoto;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="souscategories")
     */
    private $cat;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="sousCat")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSousCatNom(): ?string
    {
        return $this->sousCatNom;
    }

    public function setSousCatNom(string $sousCatNom): self
    {
        $this->sousCatNom = $sousCatNom;

        return $this;
    }

    public function getSousCatPhoto(): ?string
    {
        return $this->sousCatPhoto;
    }

    public function setSousCatPhoto(string $sousCatPhoto): self
    {
        $this->sousCatPhoto = $sousCatPhoto;

        return $this;
    }

    public function getCat(): ?Categories
    {
        return $this->cat;
    }

    public function setCat(?Categories $cat): self
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setSousCat($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getSousCat() === $this) {
                $produit->setSousCat(null);
            }
        }

        return $this;
    }
}
