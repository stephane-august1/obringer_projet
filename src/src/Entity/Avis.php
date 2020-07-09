<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 */
class Avis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qualite;

    /**
     * @ORM\Column(type="integer")
     */
    private $delais;

    /**
     * @ORM\Column(type="integer")
     */
    private $expertise;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $produitconcerne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="avis")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQualite(): ?int
    {
        return $this->qualite;
    }

    public function setQualite(int $qualite): self
    {
        $this->qualite = $qualite;

        return $this;
    }

    public function getDelais(): ?int
    {
        return $this->delais;
    }

    public function setDelais(int $delais): self
    {
        $this->delais = $delais;

        return $this;
    }

    public function getExpertise(): ?int
    {
        return $this->expertise;
    }

    public function setExpertise(int $expertise): self
    {
        $this->expertise = $expertise;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getProduitconcerne(): ?string
    {
        return $this->produitconcerne;
    }

    public function setProduitconcerne(?string $produitconcerne): self
    {
        $this->produitconcerne = $produitconcerne;

        return $this;
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
}
