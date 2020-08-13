<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_achat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Etat;

    /**
     * @ORM\OneToOne(targetEntity=ContenuPanier::class, mappedBy="Panier", cascade={"persist", "remove"})
     */
    private $contenuPanier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->Date_achat;
    }

    public function setDateAchat(\DateTimeInterface $Date_achat): self
    {
        $this->Date_achat = $Date_achat;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->Etat;
    }

    public function setEtat(bool $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getContenuPanier(): ?ContenuPanier
    {
        return $this->contenuPanier;
    }

    public function setContenuPanier(ContenuPanier $contenuPanier): self
    {
        $this->contenuPanier = $contenuPanier;

        // set the owning side of the relation if necessary
        if ($contenuPanier->getPanier() !== $this) {
            $contenuPanier->setPanier($this);
        }

        return $this;
    }
}
