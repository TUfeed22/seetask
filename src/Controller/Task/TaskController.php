<?php

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Entity\Project;
use App\Entity\Task;
use App\Enum\Status;
use App\Form\AddAndUpdateProjectFormType;
use App\Form\AddAndUpdateTaskFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends BaseController
{
    #[Route('/tasks', name: 'app_task')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'title' => 'Задачи',
            'tasks' => $this->getCurrentUser()->getTasks(),
        ]);
    }

    /**
     * Добавление новой задачи
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('task/add', name: 'app_task_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();

        $form = $this->createForm(AddAndUpdateTaskFormType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Добавить проект привязав к текущему пользователю
            $this->getCurrentUser()->addTask($task);
            // По умолчанию статус Новый
            $task->setStatus(Status::New->value);

            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('app_task');
        }

        return $this->render('task/add.html.twig', [
            'title' => 'Создание новой задачи',
            'addAndUpdateTaskForm' => $form->createView()
        ]);

    }
    #[Route('task/show/{id}', name: 'app_task_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager)
    {
        /**
         * @var Task $project
         */
        $task = $entityManager->find(Task::class, $id);
        return $this->render('task/show.html.twig', [
            'title' => $task->getName(),
            'task' => $task
        ]);
    }
}
