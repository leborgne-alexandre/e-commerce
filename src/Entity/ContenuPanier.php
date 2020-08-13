<?php

namespace App\Entity;

use App\Repository\ContenuPanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContenuPanierRepository::class)
 */
class ContenuPanier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="contenuPaniers")
     */
    private $Produit;

    /**
     * @ORM\OneToOne(targetEntity=Panier::class, inversedBy="contenuPanier", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Panier;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantite;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    public function __construct()
    {
        $this->Quantite = 1;
        $this->Date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): ?Collection
    {
        return $this->Produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->Produit->contains($produit)) {
            $this->Produit->removeElement($produit);
        }

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->Panier;
    }

    public function setPanier(Panier $Panier): self
    {
        $this->Panier = $Panier;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }
}
