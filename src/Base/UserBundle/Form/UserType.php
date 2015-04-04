<?php

namespace Base\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UserType for form type.
 */
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
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
            )
            ->add(
                'roles',
                'choice',
                [
                    'required' => false,
                    'translation_domain' => 'FOSUserBundle',
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => $this->refactorRoles(),
                    'attr' => ['class' => 'checkbox'],
                ]
            )
            ->add(
                'locked',
                null,
                [
                    'label' => 'form.locked',
                    'translation_domain' => 'FOSUserBundle',
                    'required' => false,
                ]
            );
    }

    /**
     * Refactor roles.
     *
     * @return mixed
     */
    private function refactorRoles()
    {
        $result['ROLE_ADMIN'] = 'admin.role_admin';

        return $result;
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
    public function getName()
    {
        return 'base_userbundle_user';
    }
}
