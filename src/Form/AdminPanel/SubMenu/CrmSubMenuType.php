<?php

namespace App\Form\AdminPanel\SubMenu;

use App\Entity\CrmMenu;
use App\Entity\CrmSubMenu;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CrmSubMenuType
 */
class CrmSubMenuType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'menu',
                EntityType::class,
                [
                    'class' => CrmMenu::class,
                    'label' => 'Menu',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('m')
                            ->where('m.deletedAt IS NULL')
                            ->orderBy('m.createdAt', 'ASC');
                    },
                    'choice_label' => 'title',
                    'constraints' => [
                        new NotBlank(),
                    ],

                ]
            )
            ->add(
                'title',
                TextType::class,
                [
                ]
            )
            ->add(
                'position',
                NumberType::class,
                [
                    'invalid_message' => 'Must be numbers!',
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
            'data_class' => CrmSubMenu::class,
        ]);
    }
}
