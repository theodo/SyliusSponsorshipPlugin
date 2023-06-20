<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Form\Constraints;

use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Repository\CustomerRepositoryInterface;
use Sylius\Component\User\Repository\UserRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class SponsorshipCouponConstraintValidator extends ConstraintValidator
{
    public function __construct(
        private UserRepositoryInterface $shopUserRepository,
    )
    {

    }
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof SponsorshipCouponConstraint) {
            throw new UnexpectedTypeException($constraint, SponsorshipCouponConstraint::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $matchingUser = $this->shopUserRepository->findOneBy(["sponsorshipCoupon" => $value]);

        if ($matchingUser !== null) {
            return;
        }

        $this->context->buildViolation($constraint->message)
        ->setParameter('{{ string }}', $value)
        ->addViolation();
    }
}
