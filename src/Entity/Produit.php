<?php

namespace App\Entity;

use App\Repository\ProduitRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


// TODO: Add relation with user when user is created 


/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(
     *  min = 1,
     *  max = 255,
     *  minMessage = "Product name must be at least {{ limit }} characters long",
     *  maxMessage = "Product name cannot be longer than {{ limit }} characters"
     * )
     */
    private $Nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;
    
    /**
     * @ORM\Column(type="float")
     * @Assert\PositiveOrZero
     */
    private $Prix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $Stock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Photo;

    /**
     * @ORM\ManyToMany(targetEntity=ContenuPanier::class, mappedBy="Produit")
     */
    private $contenuPaniers;

    public function __construct()
    {
        $this->contenuPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): self
    {
        $this->Stock = $Stock;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    /**
     * @return Collection|ContenuPanier[]
     */
    public function getContenuPaniers(): Collection
    {
        return $this->contenuPaniers;
    }

    public function addContenuPanier(ContenuPanier $contenuPanier): self
    {
        if (!$this->contenuPaniers->contains($contenuPanier)) {
            $this->contenuPaniers[] = $contenuPanier;
            $contenuPanier->addProduit($this);
        }

        return $this;
    }

    public function removeContenuPanier(ContenuPanier $contenuPanier): self
    {
        if ($this->contenuPaniers->contains($contenuPanier)) {
            $this->contenuPaniers->removeElement($contenuPanier);
            $contenuPanier->removeProduit($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Nom;
    }
}
