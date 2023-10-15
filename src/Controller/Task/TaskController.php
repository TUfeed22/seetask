<?php

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Entity\Task;
use App\Enum\Status;
use App\Form\AddAndUpdateTaskFormType;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED')]
class TaskController extends BaseController
{
    /**
     * Список задач
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param TaskRepository $taskRepository
     * @param UserService $userService
     * @return Response
     */
    #[Route('/tasks', name: 'app_task')]
    public function index(Request $request, PaginatorInterface $paginator, TaskRepository $taskRepository, UserService $userService): Response
    {
        $taskRepository->preparingObjectsByCreator($userService->getCurrentUser());
        $startNumPage = $request->query->getInt('page', 1);

        return $this->render('task/index.html.twig', [
            'title' => 'Задачи',
            'subtitle' => 'Список доступных задач',
            'tasks' => $taskRepository->pagination($paginator, $startNumPage),
        ]);
    }

    /**
     * Добавление новой задачи
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('task/add', name: 'app_task_add')]
    public function add(Request $request, EntityManagerInterface $entityManager, ProjectRepository $projectRepository, UserService $userService): Response
    {
        $task = new Task();
        $projectRepository->preparingObjectsByCreator($userService->getCurrentUser());

        $form = $this->createForm(AddAndUpdateTaskFormType::class, $task, $projectRepository->getOptionsToSelect());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Добавить проект привязав к текущему пользователю
            $this->getCurrentUser()->addTask($task);
            // По умолчанию статус Новый
            $task->setStatus(Status::new->value);

            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('app_task');
        }

        return $this->render('task/add.html.twig', [
            'title' => 'Новая задача',
            'subtitle' => 'Создание новой задачи',
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
            'subtitle' => 'Подробное описание задачи',
            'task' => $task
        ]);
    }

    /**
     * Обновить проект
     *
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('task/update/{id}', name: 'app_task_update', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager, ProjectRepository $projectRepository, UserService $userService): Response
    {
        /**
         * @var Task $task
         */

        $task = $entityManager->find(Task::class, $id);
        $projectRepository->preparingObjectsByCreator($userService->getCurrentUser());

        $form = $this->createForm(AddAndUpdateTaskFormType::class, $task, $projectRepository->getOptionsToSelect());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('app_task_show', ['id' => $id]);
        }

        return $this->render('task/update.html.twig', [
            'title' => $task->getName(),
            'subtitle' => 'Редактирование задачи',
            'task' => $task,
            'addTaskForm' => $form->createView()
        ]);
    }
}
