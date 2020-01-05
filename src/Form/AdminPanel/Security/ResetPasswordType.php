<?php


namespace App\Form\AdminPanel\Security;

use App\Form\AdminPanel\Model\UserResetPassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ResetPasswordType
 */
class ResetPasswordType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Passwords must be the same',
                'first_options'  => ['attr' =>
                    [ 'placeholder' =>'New password'],
                    'required' => false,
                    'label' => false,
                ],
                'second_options' => ['attr' =>
                    ['placeholder' => 'Confirm your new password'],
                    'required' => false,
                    'label' => false,
                ],
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => UserResetPassword::class,
            ]
        );
    }
}