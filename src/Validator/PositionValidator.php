<?php


namespace App\Validator;

use App\Repository\CrmMenuRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PositionValidator
 */
class PositionValidator extends ConstraintValidator
{

    /**
     * @var CrmMenuRepository
     */
    private $menuPosition;

    /**
     * PositionValidator constructor.
     *
     * @param CrmMenuRepository $menuPosition
     */
    public function __construct(CrmMenuRepository $menuPosition)
    {
        $this->menuPosition = $menuPosition;
    }

    /**
     * @param mixed      $value
     * @param Constraint $constraint
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function validate($value, Constraint $constraint)
    {

        $crmMenu = $this->menuPosition->isPosition($value);

        if (!empty($crmMenu)) {

            $editCrmMenu = $this->context->getRoot()->getData();

            if ($editCrmMenu->getId() === $crmMenu->getId() &&
                $editCrmMenu->getPosition() && $crmMenu->getPosition()) {

                return;
            }

            $this
                ->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ position }}', $value)
                ->addViolation();
        }

    }

}