<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $subject;

    #[ORM\Column(type: 'integer')]
    private $totalLesson;


    #[ORM\ManyToMany(targetEntity: Student::class, mappedBy: 'classes')]
    private $students;

    #[ORM\Column(type: 'string', length: 255)]
    private $lecturer;

    public function __construct()
    {
        $this->students = new ArrayCollection();
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

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getTotalLesson(): ?int
    {
        return $this->totalLesson;
    }

    public function setTotalLesson(int $totalLesson): self
    {
        $this->totalLesson = $totalLesson;

        return $this;
    }


    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->addClass($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            $student->removeClass($this);
        }

        return $this;
    }

    public function getLecturer(): ?string
    {
        return $this->lecturer;
    }

    public function setLecturer(string $lecturer): self
    {
        $this->lecturer = $lecturer;

        return $this;
    }
}
