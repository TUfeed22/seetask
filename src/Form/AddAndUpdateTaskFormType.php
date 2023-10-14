<?php

namespace App\Form;

use App\Entity\Task;
use App\Form\Type\SelectType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAndUpdateTaskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'id' => 'custom-id',
                    'placeholder' => 'Название задачи',
                    'class' => 'form-control'
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'id' => 'custom-id',
                    'placeholder' => 'Описание описание',
                    'class' => 'form-control form-control-height',
                ],
                'required' => false
            ])
            ->add('project', SelectType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => $options['options'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'options' => [], // по умолчанию
        ]);
    }
}
