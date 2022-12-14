<?php

namespace App\Form;

use App\Entity\Todolist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;



class TodolistType extends AbstractType
{


  public function buildform(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add("name", TextType::class, [
        "label" => "Nom de la liste",
      ])
      ->add("color", ColorType::class, [
        "label" => "Couleur de la liste",
      ]);
  }



  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      "data_class" => Todolist::class
    ]);
  }
}
