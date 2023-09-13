<?php

namespace App\Controller\Project;

use App\Controller\BaseController;
use App\Entity\Project;
use App\Enum\Status;
use App\Form\AddProjectFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends BaseController
{
    /**
     * Список проектов
     * @return Response
     */
    #[Route('/projects', name: 'app_project')]
    public function index(): Response
    {

        return $this->render('project/index.html.twig', [
            'title' => 'Проекты',
            'projects' => $this->getCurrentUser()->getProjects()
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

        $form = $this->createForm(AddProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Добавить проект привязав к текущему пользователю
            $this->getCurrentUser()->addProject($project);
            // По умолчанию статус Новый
            $project->setStatus(Status::New->value);

            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project');
        }

        return $this->render('project/add.html.twig', [
            'title' => 'Создание нового проекта',
            'addProjectForm' => $form->createView()
        ]);

    }

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

    #[Route('project/update/{id}', name: 'app_project_update', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = $entityManager->find(Project::class, $id);

        $form = $this->createForm(AddProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Добавить проект привязав к текущему пользователю
            $this->getCurrentUser()->addProject($project);
            // По умолчанию статус Новый
            $project->setStatus(Status::New->value);

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

    #[Route('project/delete/{id}', name: 'app_project_delete', methods: ['GET'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $project = $entityManager->find(Project::class, $id);
        $entityManager->remove($project);
        $entityManager->flush();

        return $this->redirectToRoute('app_project');
    }
}
