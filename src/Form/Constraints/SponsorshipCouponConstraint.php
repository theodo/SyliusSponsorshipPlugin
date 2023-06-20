<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Form\Constraints;

use Symfony\Component\Validator\Constraint;

class SponsorshipCouponConstraint extends Constraint
{
    public string $message = 'The coupon "{{ string }}" does not belong to any user.';

    public function __construct(
        array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);
    }
}
