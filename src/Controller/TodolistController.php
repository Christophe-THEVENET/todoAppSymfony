<?php

namespace App\Controller;

use App\Entity\Todolist;
use App\Form\TodolistType;
use App\Repository\TodolistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class TodolistController extends AbstractController
{


  // =================== CREER LISTE =====================
  #[Route("/create-list", name: 'app_create_list')]
  public function createList(Request $request, EntityManagerInterface $em): Response
  {
    $todolist = new Todolist();
    // le formulaire hydrate l objet Todolist
    $form = $this->createForm(TodolistType::class, $todolist);
    // soumission du formulaire
    $form->handleRequest($request);
    // est ce que le formulaire a bien été soumis sans erreurs de validation
    if ($form->isSubmitted() && $form->isValid()) {
      // recup l entityManager qui permet de synchroniser les éléments en BDD
      $em->persist($todolist);
      $em->flush();
      return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
    return $this->renderForm("list/create.html.twig", [
      "formulaire" => $form
    ]);
  }

  // =================== TOUTES LES LISTES (HOME) =====================
  #[Route("/", name: 'app_home')]
  public function getAllList(Request $request, TodolistRepository $todolistRepository): Response
  {
    $allList = $todolistRepository->findAll();

    return $this->renderForm("list/index.html.twig", [
      "allList" => $allList
    ]);
  }




  // =================== MODIFIER LISTE =====================
  #[Route("/update-list/{id}", name: 'app_update_list')]
  public function updateList(TodolistRepository $todolistRepository, Todolist $list, Request $request): Response
  {
    // le formulaire hydrate l objet Todolist
    $form = $this->createForm(TodolistType::class, $list);
    // soumission du formulaire
    $form->handleRequest($request);
    // est ce que le formulaire a bien été soumis sans erreurs de validation
    if ($form->isSubmitted() && $form->isValid()) {
      // le repository qui permet de synchroniser les éléments en BDD
      $todolistRepository->add($list, true);
      return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
    return $this->renderForm("list/create.html.twig", [
      "formulaire" => $form,
      "list" => $list
    ]);
  }



  // =================== SUPPRIMER LISTE =====================
  #[Route("/delete-list/{id}", name: 'app_delete_list')]
  public function deleteList(TodolistRepository $todolistRepository, Todolist $list): Response
  {
    // le repository qui permet de synchroniser les éléments en BDD
    $todolistRepository->remove($list, true);
    
    return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
  }
}
