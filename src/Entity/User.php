<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *  fields={"email"},
 * message="L'email que vous avez indiqué est déjà utilisé !"
 *)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Email(
     *     message = "Le champ '{{ value }}' n'est pas un email valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 120,
     *      minMessage = "Votre mot de passe doit etre au minimum de {{ limit }} characteres de long",
     *      maxMessage = "Votre mot de passe doit etre au maximum de {{ limit }} characteres de long"
     * )
     *
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password",message="Vous n'avez pas tapé le même mot de passe ! ")
     */
    public $confirm_password;
    private $newpassword;
    private $currentpassword;

    /**
     * @ORM\OneToMany(targetEntity=Blog::class, mappedBy="user")
     */
    private $blogs;

    public function __construct()
    {
        $this->blogs = new ArrayCollection();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): ?array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getNewPassword(): string
    {
        return (string) $this->newpassword;
    }
    public function setNewPassword(string $newpassword): self
    {
        $this->newpassword = $newpassword;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getCurrentPassword(): string
    {
        return (string) $this->currentpassword;
    }
    public function setCurrentPassword(string $currentpassword): self
    {
        $this->currentpassword = $currentpassword;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Blog[]
     */
    public function getBlogs(): Collection
    {
        return $this->blogs;
    }

    public function addBlog(Blog $blog): self
    {
        if (!$this->blogs->contains($blog)) {
            $this->blogs[] = $blog;
            $blog->setUser($this);
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        if ($this->blogs->contains($blog)) {
            $this->blogs->removeElement($blog);
            // set the owning side to null (unless already changed)
            if ($blog->getUser() === $this) {
                $blog->setUser(null);
            }
        }

        return $this;
    }
}
