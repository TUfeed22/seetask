<?php

namespace App\Form\Type;

use App\Service\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Список проектов для
 */
class SelectType extends AbstractType
{
    private Service $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
/*
        // список проектов доступные текущему пользователю
        $products = $this->service->getCurrentUser()->getProjects();
        foreach ($products as $product) {
            $options[$product->getName()] = $product;
        }

        $resolver->setDefaults([
            'choices' => $options
        ]);
*/
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
