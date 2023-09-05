<?php

namespace App\Controller\Project;

use App\Controller\BaseController;
use App\Entity\Project;
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
            $this->getCurrentUser()->addProject($project);
            $entityManager->persist($project);
            $entityManager->flush();
        }

        return $this->render('project/add.html.twig', [
            'title' => 'Создание нового проекта',
            'addProjectForm' => $form->createView()
        ]);

    }
}
