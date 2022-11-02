<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // pour les contraintes de validation avec validator définies par les attributs (composer r validator) et #[Assert\]



#[ORM\Entity, ORM\Table(name: "list")]
class Todolist
{

  #[ORM\Id, ORM\Column(type: "integer"), ORM\GeneratedValue(strategy: "AUTO")]
  private int  $id;
  #[Assert\Type('string')]
  #[Assert\NotBlank(message: 'Veuillez renseigner le nom de la liste')]
  #[Assert\Length(min:2,max:70,minMessage:"Le nom saisi est trop court",maxMessage:"Le nom saisi est trop long")]
  private string $name;
  #[Assert\Type('string')]
  #[Assert\NotBlank(message: 'Veuillez renseigner la couleur de la liste')]
  #[Assert\Length(min:2,max:10,minMessage:"La couleur saisie est trop courte",maxMessage:"La couleur saisie est trop longue")]
  private string $color;


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
}
