<?php


namespace App\Validator;

use App\Repository\CrmMenuRepository;
use App\Repository\CrmSubMenuRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PositionSubValidator
 */
class PositionSubValidator extends ConstraintValidator
{

    /**
     * @var CrmMenuRepository
     */
    private $subMenuPosition;

    /**
     * PositionSubValidator constructor.
     *
     * @param CrmSubMenuRepository $subMenuPosition
     */
    public function __construct(CrmSubMenuRepository $subMenuPosition)
    {
        $this->subMenuPosition = $subMenuPosition;
    }

    /**
     * @param mixed      $value
     * @param Constraint $constraint
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function validate($value, Constraint $constraint)
    {
        $menuId = $this->context->getRoot()->getData();

        $crmSubMenu = $this->subMenuPosition->isPosition($value, $menuId->getMenu()->getId());

        if (!empty($crmSubMenu)) {

            $editCrmSubMenu= $this->context->getRoot()->getData();

            if ($editCrmSubMenu->getId() === $crmSubMenu->getId() &&
                $editCrmSubMenu->getPosition() && $crmSubMenu->getPosition()) {

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