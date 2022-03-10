<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $hotline;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $room;

    #[ORM\ManyToMany(targetEntity: Manager::class, mappedBy: 'department')]
    private $manager;

    public function __construct()
    {
        $this->manager = new ArrayCollection();
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

    public function getHotline(): ?string
    {
        return $this->hotline;
    }

    public function setHotline(string $hotline): self
    {
        $this->hotline = $hotline;

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

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(string $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return Collection<int, Manager>
     */
    public function getManager(): Collection
    {
        return $this->manager;
    }

    public function addManager(Manager $manager): self
    {
        if (!$this->manager->contains($manager)) {
            $this->manager[] = $manager;
            $manager->addDepartment($this);
        }

        return $this;
    }

    public function removeManager(Manager $manager): self
    {
        if ($this->manager->removeElement($manager)) {
            $manager->removeDepartment($this);
        }

        return $this;
    }
}
