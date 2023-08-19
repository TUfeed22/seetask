<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('_username', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-xl',
                    'placeholder' => 'Email',
                ],
            ])
            ->add('_password', PasswordType::class, [
                'label' => false,
                'attr' => ['class' => 'form-control form-control-xl', 'placeholder' => 'Пароль'],
            ])
            ->add('_remember_me', CheckboxType::class, [
                'attr' => ['class' => 'form-check-input', 'required' => false],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
