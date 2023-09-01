<?php

namespace App\Controller\User;


use App\Entity\User;
use App\Form\EditUserFormType;
use App\Service\RoleService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function profile(Request $request, RoleService $roleService): Response
    {
        // получаем наименование ролей
        $roleNames = $roleService->getRoleName($this->getUser()->getRoles());

        $user = new User();
        $form = $this->createForm(EditUserFormType::class, $user);
        $form->handleRequest($request);

        return $this->render('user/index.html.twig', [
            'title' => 'Мой профиль',
            'role_names' => $roleNames,
            'editUserForm' => $form->createView(),
        ]);
    }
}
