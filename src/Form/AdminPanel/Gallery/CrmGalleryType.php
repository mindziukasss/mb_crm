<?php

namespace App\Form\AdminPanel\Gallery;

use App\Entity\CrmGallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GalleryType
 */
class CrmGalleryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                ]
            )
            ->add(
                'enabled',
                CheckboxType::class,
                [
                    'attr' => ['checked' => !isset($options['data']) ? 'checked' : $options['data']->isEnabled()],
                    'required' => false,
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CrmGallery::class,
        ]);
    }
}
