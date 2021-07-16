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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="paniers")
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $dataAchat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\OneToOne(targetEntity=ContenuPanier::class, mappedBy="panier", cascade={"persist", "remove"})
     */
    private $contenuPanier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDataAchat(): ?\DateTimeInterface
    {
        return $this->dataAchat;
    }

    public function setDataAchat(\DateTimeInterface $dataAchat): self
    {
        $this->dataAchat = $dataAchat;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getContenuPanier(): ?ContenuPanier
    {
        return $this->contenuPanier;
    }

    public function setContenuPanier(?ContenuPanier $contenuPanier): self
    {
        // unset the owning side of the relation if necessary
        if ($contenuPanier === null && $this->contenuPanier !== null) {
            $this->contenuPanier->setPanier(null);
        }

        // set the owning side of the relation if necessary
        if ($contenuPanier !== null && $contenuPanier->getPanier() !== $this) {
            $contenuPanier->setPanier($this);
        }

        $this->contenuPanier = $contenuPanier;

        return $this;
    }
}
