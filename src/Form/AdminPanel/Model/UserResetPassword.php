<?php


namespace App\Form\AdminPanel\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserResetPassword
 */
class UserResetPassword
{
    /**
     * @Assert\NotBlank(message="Choose a password!")
     * @Assert\Length(min=8,minMessage="Come on, you can think of a password logger than that!")
     */
    public $plainPassword;

}