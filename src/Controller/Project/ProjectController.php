<?php

namespace App\Controller\Project;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/projects', name: 'app_project')]
    public function index(): Response
    {
        return $this->render('project/index.html.twig', [
            'title' => 'Проекты',
        ]);
    }

    #[Route('project/add', name: 'app_project_add')]
    public function add()
    {
        $project = new Project();

        return $this->render('project/add.html.twig');

    }
}
