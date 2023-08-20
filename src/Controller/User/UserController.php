<?php

namespace App\Controller\User;


use App\Service\RoleService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED')]
class UserController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/user/profile', name: 'app_user_profile')]
    public function profile(RoleService $roleService): Response
    {
        // получаем наименование ролей
        $roleNames = $roleService->getRoleName($this->getUser()->getRoles());

        return $this->render('user/index.html.twig', [
            'title' => 'Мой профиль',
            'role_names' => $roleNames
        ]);
    }
}
