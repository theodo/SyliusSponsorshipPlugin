<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Model;

use Sylius\Component\Core\Model\PromotionCouponInterface;

trait SponsorshipShopUserTrait {

    /**
     * @ORM\OneToOne(targetEntity="Acme\SyliusSponsorshipPlugin\Model\SponsorshipPromotionCouponInterface", cascade={"persist"})
     * @ORM\JoinColumn(name="sponsorship_coupon_id", nullable=true)
     */
    private ?PromotionCouponInterface $sponsorshipCoupon = null;

    public function setSponsorshipCoupon(?PromotionCouponInterface $sponsorshipCoupon): void
    {
        $this->sponsorshipCoupon = $sponsorshipCoupon;
    }

    public function getSponsorshipCoupon(): ?PromotionCouponInterface
    {
        return $this->sponsorshipCoupon;
    }
}
