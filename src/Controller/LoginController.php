<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        //$form = $this->createForm(LoginFormType::class);
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $errorMessage = '';
/*
        if ($error->getMessageKey() == 'Invalid credentials.') {
            $errorMessage = 'Неверные почта или пароль';
        }
*/
        return $this->render('login/index.html.twig', [
            'title' => 'Вход',
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}
