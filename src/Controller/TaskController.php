<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Entity\Todolist;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{

    // =================== AJOUTER UNE TACHE=====================
    #[Route('/create-task/{id}', name: 'app_create_task')]
    public function createTask(Request $request, EntityManagerInterface $em, Todolist $list): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        // soumission du formulaire
        $form->handleRequest($request);
        // est ce que le formulaire a bien été soumis sans erreurs de validation
        if ($form->isSubmitted() && $form->isValid()) {
            // la tache n'est pas complété a la création
            $task->setCompleted(false);
            // lien de la tache a sa liste avec l id de l'url es le ParamConverter
            $task->setList($list);
            // recup l entityManager qui permet de synchroniser les éléments en BDD
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm("task/create.html.twig", [
            "formulaire" => $form,
            "list" => $list
        ]);
    }



    // =================== SUPPRIMER TACHE=====================
    #[Route('/delete-task/{id}', name: 'app_delete_task')]
    public function deleteTask(TaskRepository $taskRepository, Task $task): Response
    {
        // le repository qui permet de synchroniser les éléments en BDD
        $taskRepository->remove($task, true);
        
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }


    // =================== METTRE A JOUR LE STATUS DE LA TACHE=====================
    #[Route("/update-task-status/{id}", name: 'app_update_task_status')]
    // il faut mettre un href dans l 'input checkbox
    public function updateTaskStatus(TaskRepository $taskRepository, Task $task): Response
    {
        $task->setCompleted(true);
        // le repository qui permet de synchroniser les éléments en BDD
        $taskRepository->save($task, true);

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}

 