<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Model;

interface SponsorshipShopUserInterface {

    public function setSponsorshipCoupon(?string $sponsorshipCoupon): void;

    public function getSponsorshipCoupon(): ?string;
}
