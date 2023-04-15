<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\EventListener;

use Sylius\Component\Core\Repository\PromotionRepositoryInterface;
use Sylius\Component\Promotion\Factory\PromotionCouponFactoryInterface;
use Sylius\Component\Core\Model\PromotionInterface;

final class UserRegistrationListener {
    public function __construct(
        private PromotionCouponFactoryInterface $promotionCouponFactory,
        private PromotionRepositoryInterface $promotionRepository,
        private string $promotionCode,
    ) {
    }
    public function createPromotionCoupon() {
        /** @var PromotionInterface $promotion */
        $promotion = $this->promotionRepository->findOneBy(['code' => $this->promotionCode]);
        $coupon = $this->promotionCouponFactory->createForPromotion($promotion);
        $myVariable = true;
        return $myVariable;
    }

}
