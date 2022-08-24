<?php

namespace App\Entity;

use App\Repository\CommercialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommercialRepository::class)
 */
class Commercial extends User
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commercialNom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commercialPrenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $commercialType;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="commercial")
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getCommercialNom(): ?string
    {
        return $this->commercialNom;
    }

    public function setCommercialNom(string $commercialNom): self
    {
        $this->commercialNom = $commercialNom;

        return $this;
    }

    public function getCommercialPrenom(): ?string
    {
        return $this->commercialPrenom;
    }

    public function setCommercialPrenom(string $commercialPrenom): self
    {
        $this->commercialPrenom = $commercialPrenom;

        return $this;
    }

    public function getCommercialType(): ?string
    {
        return $this->commercialType;
    }

    public function setCommercialType(string $commercialType): self
    {
        $this->commercialType = $commercialType;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setCommercial($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getCommercial() === $this) {
                $client->setCommercial(null);
            }
        }

        return $this;
    }
}
