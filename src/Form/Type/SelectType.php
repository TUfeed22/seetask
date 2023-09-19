<?php

namespace App\Form\Type;

use App\Service\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectType extends AbstractType
{
    private Service $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    public function configureOptions(OptionsResolver $resolver)
    {

        $products = $this->service->getCurrentUser()->getProjects();

        $options = [];
        foreach ($products as $product) {
            $options[$product->getName()] = $product;
        }

        $resolver->setDefaults([
            'choices' => $options
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
