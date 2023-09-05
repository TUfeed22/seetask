<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * Текущий пользователь
     * @return User
     */
    protected function getCurrentUser(): User
    {
        /**
         * @var \App\Entity\User $user
         */
        $user = $this->getUser();
        return $user;

    }
}
