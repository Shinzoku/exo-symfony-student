<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 190)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 190)]
    private $lastname;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $success;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: SchoolYear::class)]
    private $schoolYear;

    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'students')]
    private $projects;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'students')]
    private $tags;

    public function __construct()
    {
        $this->schoolYear = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function isSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(?bool $success): self
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @return Collection<int, SchoolYear>
     */
    public function getSchoolYear(): Collection
    {
        return $this->schoolYear;
    }

    public function addSchoolYear(SchoolYear $schoolYear): self
    {
        if (!$this->schoolYear->contains($schoolYear)) {
            $this->schoolYear[] = $schoolYear;
            $schoolYear->setStudent($this);
        }

        return $this;
    }

    public function removeSchoolYear(SchoolYear $schoolYear): self
    {
        if ($this->schoolYear->removeElement($schoolYear)) {
            // set the owning side to null (unless already changed)
            if ($schoolYear->getStudent() === $this) {
                $schoolYear->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        $this->projects->removeElement($project);

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }
}
