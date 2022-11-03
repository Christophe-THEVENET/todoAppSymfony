<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class TaskType extends AbstractType
{


  public function buildform(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add("title", TextType::class, [
        "label" => "Titre de la tache",
      ]);
     
  }



  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      "data_class" => Task::class
    ]);
  }
}
