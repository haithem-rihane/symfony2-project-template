<?php

namespace Base\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

/**
 * Class ProfileFormType.
 */
class ProfileFormType extends BaseType
{
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

        $this->buildUserForm($builder, $options);

        $builder->add(
            'current_password',
            'password',
            [
                'label' => 'form.current_password',
                'translation_domain' => 'FOSUserBundle',
                'mapped' => false,
                'constraints' => $constraint,
                'attr' => ['class' => 'form-control', 'placeholder' => 'form.current_password'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'base_user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Base\UserBundle\Entity\User',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
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
                'name',
                null,
                [
                    'label' => 'form.name',
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.name'],
                ]
            )
            ->add(
                'surname',
                null,
                [
                    'label' => 'form.surname',
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.surname'],
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
            );
    }
}
