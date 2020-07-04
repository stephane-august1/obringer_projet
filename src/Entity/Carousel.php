<?php

namespace App\Entity;

use App\Repository\CarouselRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarouselRepository::class)
 */
class Carousel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $srcimagecarousel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptioncarousel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titlecarousel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categories;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSrcimagecarousel(): ?string
    {
        return $this->srcimagecarousel;
    }

    public function setSrcimagecarousel(string $srcimagecarousel): self
    {
        $this->srcimagecarousel = $srcimagecarousel;

        return $this;
    }

    public function getDescriptioncarousel(): ?string
    {
        return $this->descriptioncarousel;
    }

    public function setDescriptioncarousel(?string $descriptioncarousel): self
    {
        $this->descriptioncarousel = $descriptioncarousel;

        return $this;
    }

    public function getTitlecarousel(): ?string
    {
        return $this->titlecarousel;
    }

    public function setTitlecarousel(?string $titlecarousel): self
    {
        $this->titlecarousel = $titlecarousel;

        return $this;
    }

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(string $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
