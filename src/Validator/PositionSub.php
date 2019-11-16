<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PositionSub extends Constraint
{
    public $message = 'This position is now!';
}