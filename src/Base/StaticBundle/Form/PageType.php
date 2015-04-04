<?php

namespace Base\StaticBundle\Form;

use Base\StaticBundle\Entity\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class PageType.
 */
class PageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                null,
                [
                    'label' => 'form.title',
                    'translation_domain' => 'StaticBundle',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.title'],
                ]
            )
            ->add(
                'groupName',
                'choice',
                [
                    'choices' => [
                        'help' => 'form.help',
                        'front_page' => 'form.front_page',
                    ],
                    'required' => false,
                    'label' => 'form.group',
                    'translation_domain' => 'StaticBundle',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.group'],
                ]
            )
            ->add(
                'text',
                'textarea',
                [
                    'label' => 'form.text',
                    'required' => false,
                    'attr' => ['class' => 'tinymce_textarea form-control'],
                ]
            )
            ->add(
                'position',
                'integer',
                [
                    'label' => 'form.position',
                    'translation_domain' => 'StaticBundle',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.position'],
                ]
            )
            ->add(
                'language',
                'choice',
                [
                    'choices' => ['lt' => 'form.lt_LT', 'en' => 'form.en_US'],
                    'label' => 'form.language',
                    'translation_domain' => 'StaticBundle',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'form.position'],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Base\StaticBundle\Entity\Page',
                'translation_domain' => 'StaticBundle',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'base_staticbundle_page';
    }
}
