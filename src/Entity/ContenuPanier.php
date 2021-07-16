<?php

namespace App\Entity;

use App\Repository\ContenuPanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContenuPanierRepository::class)
 */
class ContenuPanier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     */
    private $produit;

    /**
     * @ORM\OneToOne(targetEntity=Panier::class, inversedBy="contenuPanier", cascade={"persist", "remove"})
     */
    private $panier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantite;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAjoutPanier;

    public function __construct()
    {
        $this->dateAjoutPanier = new \DateTime();
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        $this->produit->removeElement($produit);

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateAjoutPanier(): ?\DateTimeInterface
    {
        return $this->dateAjoutPanier;
    }

    public function setDateAjoutPanier(\DateTimeInterface $dateAjoutPanier): self
    {
        $this->dateAjoutPanier = $dateAjoutPanier;

        return $this;
    }
}
