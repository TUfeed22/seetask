<?php

namespace App\Controller\Task;

use App\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends BaseController
{
    #[Route('/tasks', name: 'app_task')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'title' => 'Задачи',
        ]);
    }
}
