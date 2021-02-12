<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $datebirth;

    /**
     * @ORM\OneToMany(targetEntity=UserTelephone::class, mappedBy="user_id", orphanRemoval=true)
     */
    private $userTelephones;

    public function __construct()
    {
        $this->userTelephones = new ArrayCollection();
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

    public function getDatebirth(): ?\DateTimeInterface
    {
        return $this->datebirth;
    }

    public function setDatebirth(\DateTimeInterface $datebirth): self
    {
        $this->datebirth = $datebirth;

        return $this;
    }

    /**
     * @return Collection|UserTelephone[]
     */
    public function getUserTelephones(): Collection
    {
        return $this->userTelephones;
    }

    public function addUserTelephone(UserTelephone $userTelephone): self
    {
        if (!$this->userTelephones->contains($userTelephone)) {
            $this->userTelephones[] = $userTelephone;
            $userTelephone->setUserId($this);
        }

        return $this;
    }

    public function removeUserTelephone(UserTelephone $userTelephone): self
    {
        if ($this->userTelephones->removeElement($userTelephone)) {
            // set the owning side to null (unless already changed)
            if ($userTelephone->getUserId() === $this) {
                $userTelephone->setUserId(null);
            }
        }

        return $this;
    }
}
