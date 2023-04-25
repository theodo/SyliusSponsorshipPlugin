<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Model;

use Sylius\Component\Core\Model\PromotionCouponInterface;

interface SponsorshipShopUserInterface {

    public function setSponsorshipCoupon(?PromotionCouponInterface $sponsorshipCoupon): void;

    public function getSponsorshipCoupon(): ?PromotionCouponInterface;
}
