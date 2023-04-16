<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Core\Model\PromotionCoupon;
use Sylius\Component\Core\Repository\PromotionRepositoryInterface;
use Sylius\Component\Promotion\Factory\PromotionCouponFactoryInterface;
use Sylius\Component\Core\Model\PromotionInterface;
use Sylius\Component\Promotion\Repository\PromotionCouponRepositoryInterface;
use Symfony\Component\String\ByteString;

final class UserRegistrationListener {
    public function __construct(
        private PromotionCouponFactoryInterface $promotionCouponFactory,
        private PromotionRepositoryInterface $promotionRepository,
        private PromotionCouponRepositoryInterface $promotionCouponRepository,
        private EntityManagerInterface $entityManager,
        private string $promotionCode,
        private int $usageLimit,
    ) {
    }
    public function createPromotionCoupon() {
        /** @var PromotionInterface $promotion */
        $promotion = $this->promotionRepository->findOneBy(['code' => $this->promotionCode]);
        $coupon = $this->promotionCouponFactory->createForPromotion($promotion);
        $coupon->setUsageLimit($this->usageLimit);
        $coupon->setCode($this->getUniqueCode());
        $this->entityManager->persist($coupon);
        $this->entityManager->flush();
        return $coupon;
    }

    private function getUniqueCode(): string
    {
        $code = ByteString::fromRandom(10, implode('', array_merge(range('A', 'Z'), range(1, 9))))->toString();
        $promotionCoupon = $this->promotionCouponRepository->findOneBy(['code' => $code]);
        if ($promotionCoupon instanceof PromotionCoupon) {
            return $this->getUniqueCode();
        }

        return $code;
    }

}
