<?php

namespace App\Entity;

use App\Repository\NavbarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NavbarRepository::class)]
class Navbar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $buttons = null;

    #[ORM\Column(length: 255, nullable: true)]
    private $link = null;

    #[ORM\Column(length: 255)]
    private ?string $route = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getButtons(): ?string
    {
        return $this->buttons;
    }

    public function setButtons(?string $buttons): static
    {
        $this->buttons = $buttons;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink($link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): static
    {
        $this->route = $route;

        return $this;
    }
}
