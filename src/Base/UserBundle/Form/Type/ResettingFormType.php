<?php

namespace Base\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ResettingFormType as BaseType;

/**
 * Class ResettingFormType.
 */
class ResettingFormType extends BaseType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'new',
            'repeated',
            [
                'type' => 'password',
                'options' => ['translation_domain' => 'FOSUserBundle'],
                'first_options' => [
                    'label' => 'form.new_password',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.new_password'],
                ],
                'second_options' => [
                    'label' => 'form.new_password_confirmation',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.new_password_confirmation'],
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
        return 'base_user_resetting';
    }
}
