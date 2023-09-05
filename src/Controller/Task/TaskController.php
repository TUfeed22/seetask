<?php

namespace App\Controller\Task;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/tasks', name: 'app_task')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'title' => 'Задачи',
        ]);
    }
}
