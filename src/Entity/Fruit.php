<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genus = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $family = null;

    #[ORM\Column(length: 255)]
    private ?string $nutritions = null;

    #[ORM\Column(length: 255)]
    private ?string $order_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(string $genus): self
    {
        $this->genus = $genus;

        return $this;
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

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getNutritions(): ?string
    {
        return $this->nutritions;
    }

    public function setNutritions(string $nutritions): self
    {
        $this->nutritions = $nutritions;

        return $this;
    }

    public function getOrderName(): ?string
    {
        return $this->order_name;
    }

    public function setOrderName(string $order_name): self
    {
        $this->order_name = $order_name;

        return $this;
    }
}
