<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $comDate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $modePaiement;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFacturation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateLivraison;

    /**
     * @ORM\OneToMany(targetEntity=Lignedecommande::class, mappedBy="com")
     */
    private $lignedecommandes;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="float")
     */
    private $comMontant;


    public function __construct()
    {
        $this->lignedecommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComDate(): ?\DateTimeInterface
    {
        return $this->comDate;
    }

    public function setComDate(\DateTimeInterface $comDate): self
    {
        $this->comDate = $comDate;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getDateFacturation(): ?\DateTimeInterface
    {
        return $this->dateFacturation;
    }

    public function setDateFacturation(\DateTimeInterface $dateFacturation): self
    {
        $this->dateFacturation = $dateFacturation;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(?\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

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
            $lignedecommande->setCom($this);
        }

        return $this;
    }

    public function removeLignedecommande(Lignedecommande $lignedecommande): self
    {
        if ($this->lignedecommandes->removeElement($lignedecommande)) {
            // set the owning side to null (unless already changed)
            if ($lignedecommande->getCom() === $this) {
                $lignedecommande->setCom(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getComMontant(): ?float
    {
        return $this->comMontant;
    }

    public function setComMontant(float $comMontant): self
    {
        $this->comMontant = $comMontant;

        return $this;
    }
}
