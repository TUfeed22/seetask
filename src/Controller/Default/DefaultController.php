<?php

namespace App\Controller\Default;

use App\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED')]
class DefaultController extends BaseController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $user = $this->getCurrentUser();
        return $this->render('default/index.html.twig', [
            'title' => 'Информационная панель',
            'projects' => $user->getProjects(),
            'tasks' => $user->getTasks(),
        ]);
    }
}
