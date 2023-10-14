<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;

class UserService
{
    public function __construct(private Security $security)
    {
    }

    /**
     * Текущий пользователь
     *
     * @return User
     */
    public function getCurrentUser(): User
    {
        /**
         * @var \App\Entity\User $user
         */
        $user = $this->security->getUser();
        return $user;
    }


}
