<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TodolistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert; // pour les contraintes de validation avec validator définies par les attributs (composer r validator) et #[Assert\]



#[ORM\Entity(repositoryClass: TodolistRepository::class), ORM\Table(name: "list")]
class Todolist
{

  #[ORM\Id, ORM\Column(type: "integer"), ORM\GeneratedValue(strategy: "AUTO")]
  private int  $id;
  #[Assert\Type('string')]
  #[Assert\NotBlank(message: 'Veuillez renseigner le nom de la liste')]
  #[Assert\Length(min:2,max:70,minMessage:"Le nom saisi est trop court",maxMessage:"Le nom saisi est trop long")]
  #[ORM\Column(type: "string", length:70)]
  private string $name;
  #[Assert\Type('string')]
  #[Assert\NotBlank(message: 'Veuillez renseigner la couleur de la liste')]
  #[Assert\Length(min:2,max:10,minMessage:"La couleur saisie est trop courte",maxMessage:"La couleur saisie est trop longue")]
  #[ORM\Column(type: "string", length:10)]
  private string $color;

  #[ORM\OneToMany(mappedBy: 'list', targetEntity: Task::class, orphanRemoval: true)]
  private Collection $tasks;

  public function __construct()
  {
      $this->tasks = new ArrayCollection();
  }


  public function getId()
  {
    return $this->id;
  }

  public function setId($id): self
  {
    $this->id = $id;

    return $this;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getColor()
  {
    return $this->color;
  }

  public function setColor($color): self
  {
    $this->color = $color;

    return $this;
  }

  public function getTasks(): Collection
  {
      return $this->tasks;
  }

  public function addTask(Task $task): self
  {
      if (!$this->tasks->contains($task)) {
          $this->tasks->add($task);
          $task->setList($this);
      }

      return $this;
  }

  public function removeTask(Task $task): self
  {
      if ($this->tasks->removeElement($task)) {
          // set the owning side to null (unless already changed)
          if ($task->getList() === $this) {
              $task->setList(null);
          }
      }

      return $this;
  }
}
