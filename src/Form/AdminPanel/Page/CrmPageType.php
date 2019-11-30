<?php

namespace App\Form\AdminPanel\Page;

use App\Entity\CrmMenu;
use App\Entity\CrmPage;

use App\Repository\CrmSubMenuRepository;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CrmPageType
 */
class CrmPageType extends AbstractType
{
    /**
     * @var CrmSubMenuRepository
     */
    private $subMenuRepository;

    /**
     * CrmPageType constructor.
     *
     * @param CrmSubMenuRepository $subMenuRepository
     */
    public function __construct(CrmSubMenuRepository $subMenuRepository)
    {
        $this->subMenuRepository = $subMenuRepository;
    }

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
                    'placeholder' => '------',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('m')
                            ->where('m.deletedAt IS NULL')
                            ->andWhere('m.enabled = :true')
                            ->setParameter('true', 1)
                            ->orderBy('m.createdAt', 'ASC');
                    },
                    'choice_label' => 'title',
                    'required' => false,

                ]
            );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();

                if (!$data) {
                    return;
                }

                $this->setupSubMenuName(
                    $event->getForm(),
                    $data->getMenu()
                );

            }
        );

        $builder->get('menu')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->setupSubMenuName(
                    $form->getParent(),
                    $form->getData()
                );
            }
        );

        $builder->add(
            'title',
            TextType::class,
            [
                'required' => false,
            ]
        )
            ->add(
                'type',
                ChoiceType::class,
                [
                    'choices' => [
                        'Page' => 'page',
                        'Blog' => 'blog',
                        'Gallery' => 'gallery',
                        'Video' => 'video',
                        'Home' => 'home',
                    ],
                ]
            )
            ->add(
                'description',
                CKEditorType::class,
                [
                    'rows' => 15,
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
        $resolver->setDefaults(
            [
                'data_class' => CrmPage::class,
            ]
        );
    }

    /**
     * @param FormInterface $form
     * @param               $menuId
     */
    private function setupSubMenuName(FormInterface $form, $menuId)
    {
        if ($menuId) {

            $subMenu = $this->subMenuRepository->getSubMenu($menuId);

            if ($subMenu) {

                $subMenuTitle = [];
                $subMenuId = [];

                foreach ($subMenu as $key => $value) {
                    $subMenuTitle[] = $value['title'];
                    $subMenuId[] = $value['id'];
                }
                $subMenu = array_combine($subMenuTitle, $subMenuId);
                $choices = $subMenu ?? $subMenu;

                $form->add(
                    'subMenu',
                    ChoiceType::class,
                    [
                        'choices' => $choices,
                    ]
                );
            }
        }

    }
}