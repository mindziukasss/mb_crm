<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Position extends Constraint
{
    public $message = 'This position is now!';
}