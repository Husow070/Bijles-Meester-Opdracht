<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $fname = null;

    #[ORM\Column(length: 255)]
    private ?string $lname = null;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Bijles::class, orphanRemoval: true)]
    private Collection $bijlessen;

    #[ORM\OneToMany(mappedBy: 'docent', targetEntity: Bijles::class, orphanRemoval: true)]
    private Collection $teacherbijles;

    public function __construct()
    {
        $this->bijlessen = new ArrayCollection();
        $this->teacherbijles = new ArrayCollection();
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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(string $fname): static
    {
        $this->fname = $fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->lname;
    }

    public function setLname(string $lname): static
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * @return Collection<int, Bijles>
     */
    public function getBijlessen(): Collection
    {
        return $this->bijlessen;
    }

    public function addBijlessen(Bijles $bijlessen): static
    {
        if (!$this->bijlessen->contains($bijlessen)) {
            $this->bijlessen->add($bijlessen);
            $bijlessen->setStudent($this);
        }

        return $this;
    }

    public function removeBijlessen(Bijles $bijlessen): static
    {
        if ($this->bijlessen->removeElement($bijlessen)) {
            // set the owning side to null (unless already changed)
            if ($bijlessen->getStudent() === $this) {
                $bijlessen->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bijles>
     */
    public function getTeacherbijles(): Collection
    {
        return $this->teacherbijles;
    }

    public function addTeacherbijle(Bijles $teacherbijle): static
    {
        if (!$this->teacherbijles->contains($teacherbijle)) {
            $this->teacherbijles->add($teacherbijle);
            $teacherbijle->setDocent($this);
        }

        return $this;
    }

    public function removeTeacherbijle(Bijles $teacherbijle): static
    {
        if ($this->teacherbijles->removeElement($teacherbijle)) {
            // set the owning side to null (unless already changed)
            if ($teacherbijle->getDocent() === $this) {
                $teacherbijle->setDocent(null);
            }
        }

        return $this;
    }
}
