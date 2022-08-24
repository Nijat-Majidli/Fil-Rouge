<?php

namespace App\Entity;

use App\Repository\LignedecommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LignedecommandeRepository::class)
 */
class Lignedecommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $remise;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="lignedecommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pro;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="lignedecommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $com;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getRemise(): ?float
    {
        return $this->remise;
    }

    public function setRemise(?float $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getPro(): ?Produit
    {
        return $this->pro;
    }

    public function setPro(?Produit $pro): self
    {
        $this->pro = $pro;

        return $this;
    }

    public function getCom(): ?Commande
    {
        return $this->com;
    }

    public function setCom(?Commande $com): self
    {
        $this->com = $com;

        return $this;
    }
}
