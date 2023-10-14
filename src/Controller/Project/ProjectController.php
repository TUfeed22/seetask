<?php

namespace App\Controller\Project;

use App\Controller\BaseController;
use App\Entity\Project;
use App\Enum\Status;
use App\Form\AddAndUpdateProjectFormType;
use App\Repository\ProjectRepository;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends BaseController
{
    /**
     * Список проектов
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param UserService $userService
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    #[Route('/projects', name: 'app_project')]
    public function index(Request $request, PaginatorInterface $paginator, UserService $userService, ProjectRepository $projectRepository): Response
    {
        $projectRepository->preparingObjectsByCreator($userService->getCurrentUser());
        $startNumPage = $request->query->getInt('page', 1);

        return $this->render('project/index.html.twig', [
            'title' => 'Проекты',
            'projects' => $projectRepository->pagination($paginator, $startNumPage),
        ]);
    }

    /**
     * Добавление нового проекта
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('project/add', name: 'app_project_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();

        $form = $this->createForm(AddAndUpdateProjectFormType::class, $project, Status::getOptionsToSelect());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Добавить проект привязав к текущему пользователю
            $this->getCurrentUser()->addProject($project);
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project');
        }

        return $this->render('project/add.html.twig', [
            'title' => 'Создание нового проекта',
            'addProjectForm' => $form->createView()
        ]);

    }

    /**
     * Просмотр проекта
     *
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('project/show/{id}', name: 'app_project_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        /**
         * @var Project $project
         */
        $project = $entityManager->find(Project::class, $id);
        return $this->render('project/show.html.twig', [
            'title' => $project->getName(),
            'project' => $project
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
    #[Route('project/update/{id}', name: 'app_project_update', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        /**
         * @var Project $project
         */

        $project = $entityManager->find(Project::class, $id);

        $form = $this->createForm(AddAndUpdateProjectFormType::class, $project, Status::getOptionsToSelect());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Добавить проект привязав к текущему пользователю
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project_show', ['id' => $id]);
        }

        return $this->render('project/update.html.twig', [
            'title' => $project->getName(),
            'project' => $project,
            'addProjectForm' => $form->createView()
        ]);
    }

    /**
     * Удалить проект
     *
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('project/delete/{id}', name: 'app_project_delete', methods: ['GET'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        /**
         * @var Project $project
         */

        $project = $entityManager->find(Project::class, $id);

        $entityManager->remove($project);

        $entityManager->flush();

        return $this->redirectToRoute('app_project');
    }
}
