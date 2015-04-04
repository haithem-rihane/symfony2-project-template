<?php

namespace Base\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use FOS\UserBundle\Form\Type\ChangePasswordFormType as BaseType;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class ChangePasswordFormType.
 */
class ChangePasswordFormType extends BaseType
{
    /**
     * @var Container
     */
    protected $container = null;

    /**
     * {@inheritdoc}
     */
    public function __construct($modelUserClass, $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (class_exists('Symfony\Component\Security\Core\Validator\Constraints\UserPassword')) {
            $constraint = new UserPassword();
        } else {
            // Symfony 2.1 support with the old constraint class.
            $constraint = new OldUserPassword();
        }

        $builder
            ->add(
                'current_password',
                'password',
                [
                    'label' => 'form.current_password',
                    'translation_domain' => 'FOSUserBundle',
                    'mapped' => false,
                    'constraints' => $constraint,
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.current_password'],
                ]
            )
            ->add(
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
        return 'base_user_change_password';
    }
}
