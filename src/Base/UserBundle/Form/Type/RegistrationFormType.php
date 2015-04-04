<?php

namespace Base\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

/**
 * Class RegistrationFormType.
 */
class RegistrationFormType extends BaseType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                null,
                [
                    'label' => 'form.username',
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.username'],
                ]
            )
            ->add(
                'email',
                'email',
                [
                    'label' => 'form.email',
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.email'],
                ]
            )
            ->add(
                'plainPassword',
                'repeated',
                [
                    'type' => 'password',
                    'options' => ['translation_domain' => 'FOSUserBundle'],
                    'first_options' => [
                        'label' => 'form.password',
                        'attr' => ['class' => 'form-control', 'placeholder' => 'form.password'],
                    ],
                    'second_options' => [
                        'label' => 'form.password_confirmation',
                        'attr' => ['class' => 'form-control', 'placeholder' => 'form.password_confirmation'],
                    ],
                    'invalid_message' => 'fos_user.password.mismatch',
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'base_user_registration';
    }
}
