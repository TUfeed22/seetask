<?php

namespace App\Form\Type;

use App\Service\UserService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Список проектов для
 */
class SelectType extends AbstractType
{
    private UserService $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
