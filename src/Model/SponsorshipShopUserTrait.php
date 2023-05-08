<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Model;

trait SponsorshipShopUserTrait {

    /** @ORM\Column(type="string", nullable=true, name="sponsorship_coupon") */
    private ?string $sponsorshipCoupon = null;

    public function setSponsorshipCoupon(?string $sponsorshipCoupon): void
    {
        $this->sponsorshipCoupon = $sponsorshipCoupon;
    }

    public function getSponsorshipCoupon(): ?string
    {
        return $this->sponsorshipCoupon;
    }
}
