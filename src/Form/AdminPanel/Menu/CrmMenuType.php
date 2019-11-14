<?php

namespace App\Form\AdminPanel\Menu;

use App\Entity\CrmMenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CrmMenuType
 */
class CrmMenuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
            ])
            ->add('position', NumberType::class,
                [
                'invalid_message' => 'Must be numbers!',
                ])
            ->add('enabled', CheckboxType::class, [
                'attr' => ['checked' => 'checked'],
                'required' => false
                ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CrmMenu::class,
        ]);
    }
}
