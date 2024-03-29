<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(min: 2, max: 180)]
    #[Assert\Email()]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private array $roles = [];

    private ?string $plainPassword = null;
    private ?string $newPassword = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = 'password';

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[Assert\NotNull()]
    #[Assert\Length(min: 2, max: 5)]
    #[ORM\Column]
    private ?int $codePostal = null;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Orders::class)]
    private Collection $orders;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $favAdresse = null;

    #[ORM\Column(nullable: true)]
    private ?int $favCodePostal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $favVille = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->orders = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
 * @return string|null
 */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    /**
     * Get the value of plainPassword
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     * 
     * @return self
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

     /**
     * Get the value of newPassword
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set the value of newPassword
     * 
     * @return self
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }
    public function __toString()
    {
        return $this->nom ." ". $this->prenom ." ". $this->adresse ." ". $this->codePostal ." ". $this->ville;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    public function getFavAdresse(): ?string
    {
        return $this->favAdresse;
    }

    public function setFavAdresse(?string $favAdresse): static
    {
        $this->favAdresse = $favAdresse;

        return $this;
    }

    public function getFavCodePostal(): ?int
    {
        return $this->favCodePostal;
    }

    public function setFavCodePostal(?int $favCodePostal): static
    {
        $this->favCodePostal = $favCodePostal;

        return $this;
    }

    public function getFavVille(): ?string
    {
        return $this->favVille;
    }

    public function setFavVille(?string $favVille): static
    {
        $this->favVille = $favVille;

        return $this;
    }
}
