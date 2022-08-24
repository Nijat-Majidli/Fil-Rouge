<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
    private $catNom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $catPhoto;

    /**
     * @ORM\OneToMany(targetEntity=Souscategories::class, mappedBy="cat")
     */
    private $souscategories;

    public function __construct()
    {
        $this->souscategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatNom(): ?string
    {
        return $this->catNom;
    }

    public function setCatNom(string $catNom): self
    {
        $this->catNom = $catNom;

        return $this;
    }

    public function getCatPhoto(): ?string
    {
        return $this->catPhoto;
    }

    public function setCatPhoto(string $catPhoto): self
    {
        $this->catPhoto = $catPhoto;

        return $this;
    }

    /**
     * @return Collection<int, Souscategories>
     */
    public function getSouscategories(): Collection
    {
        return $this->souscategories;
    }

    public function addSouscategory(Souscategories $souscategory): self
    {
        if (!$this->souscategories->contains($souscategory)) {
            $this->souscategories[] = $souscategory;
            $souscategory->setCat($this);
        }

        return $this;
    }

    public function removeSouscategory(Souscategories $souscategory): self
    {
        if ($this->souscategories->removeElement($souscategory)) {
            // set the owning side to null (unless already changed)
            if ($souscategory->getCat() === $this) {
                $souscategory->setCat(null);
            }
        }

        return $this;
    }
}
