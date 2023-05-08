<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Core\Model\PromotionCoupon;
use Sylius\Component\Core\Repository\PromotionRepositoryInterface;
use Sylius\Component\Promotion\Factory\PromotionCouponFactoryInterface;
use Sylius\Component\Core\Model\PromotionInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Promotion\Repository\PromotionCouponRepositoryInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\String\ByteString;
use Webmozart\Assert\Assert;

final class UserRegistrationListener {
    public function __construct(
        private PromotionCouponFactoryInterface $promotionCouponFactory,
        private PromotionRepositoryInterface $promotionRepository,
        private PromotionCouponRepositoryInterface $promotionCouponRepository,
        private EntityManagerInterface $entityManager,
        private string $promotionCode,
        private int $usageLimit,
        private CustomerContextInterface $customerContext,
    ) {
    }
    public function createPromotionCoupon(GenericEvent $event) {
        $customer = $event->getSubject();
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();

        Assert::notNull($user);
        $user = $customer->getUser();
        $uniqueCode = $this->getUniqueCode();
        $user->setSponsorshipCoupon($uniqueCode);
        $this->entityManager->flush();
        return;
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
