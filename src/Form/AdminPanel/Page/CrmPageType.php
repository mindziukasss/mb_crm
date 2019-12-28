<?php

namespace App\Form\AdminPanel\Page;

use App\Entity\CrmMenu;
use App\Entity\CrmPage;

use App\EventListener\Gallery\AddGallery;
use App\Repository\CrmGalleryRepository;
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


    private $galleryRepository;

    /**
     * CrmPageType constructor.
     *
     * @param CrmSubMenuRepository $subMenuRepository
     * @param CrmGalleryRepository $galleryRepository
     */
    public function __construct(CrmSubMenuRepository $subMenuRepository, CrmGalleryRepository $galleryRepository)
    {
        $this->subMenuRepository = $subMenuRepository;
        $this->galleryRepository = $galleryRepository;
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

                if ($data->getType()) {
                    $this->getPageType($event->getForm(), $data->getType());
                }

                if ($data->getMenu()) {
                    $this->setupSubMenuName($event->getForm(), $data->getMenu());
                }

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

        $builder->get('type')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {

                $form = $event->getForm();
                $this->getPageType(
                    $form->getParent(),
                    $form->getData()
                );
            }
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

    /**
     * @param string $type
     *
     * @return array|false|mixed
     */
    private function getGalleryList(string $type)
    {

        if ($type === 'gallery') {

            $galleries = $this->galleryRepository->getGalleryTitle();

            $galleryTitle = [];
            $galleryId = [];

            foreach ($galleries as $key => $value) {

                $galleryTitle[] = $value['title'];
                $galleryId[] = $value['id'];
            }

            $galleries = array_combine($galleryTitle, $galleryId);

            return $galleries;
        }

    }

    /**
     * @param FormInterface $form
     * @param string|null   $type
     */
    private function getPageType(FormInterface $form, ?string $type)
    {
        if (null === $type) {
            $form->remove('gallery');

            return;
        }

        $choices = $this->getGalleryList($type);

        if (null === $choices) {
            $form->remove('gallery');

            return;
        }

        $form->add('gallery', ChoiceType::class, [
            'placeholder' => 'Choice gallery',
            'choices' => $choices,
            'required' => false,
        ]);

    }
}