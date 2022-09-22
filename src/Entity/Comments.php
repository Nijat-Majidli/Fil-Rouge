<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "post"={
 *               "security"="is_granted('IS_AUTHENTICATED_FULLY', object)",
 *               "normalization_context"={"groups"={"read:comment", "read:comment:full"}}
 *          },
 *          "get"={
 *              "normalization_context"={"groups"={"read:comment", "read:comment:full"}}
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"read:comment", "read:comment:full"}}
 *           },
 *          "put"={
 *              "security"="is_granted('EDIT_COMMENT', object)",
 *              "denormalization_context"={"groups"="update:comment"}
 *          },
 *          "delete"={
 *              "normalization_context"={"groups"="delete:comment"}
 *           }
 *      }
 * )
 */
class Comments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:comment"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:comment", "update:comment", "delete:comment"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:comment"}) 
     */
    private $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:comment", "update:comment"})
     */
    private $updateDate;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:comment:full"})
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:comment"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function getProduit(): ?produit
    {
        return $this->produit;
    }

    public function setProduit(?produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
