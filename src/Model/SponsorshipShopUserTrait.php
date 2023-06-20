<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Model;

use Sylius\Component\Core\Model\ShopUserInterface;

trait SponsorshipShopUserTrait {

    /** @ORM\Column(type="string", nullable=true, name="sponsorship_coupon") */
    private ?string $sponsorshipCoupon = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\ShopUser", inversedBy="sponsoredUsers")
     * @ORM\JoinColumn(name="sponsor_id", nullable=true, onDelete="SET NULL")
     */
    private ?ShopUserInterface $sponsorshipSponsor = null;

    private array $sponsoredUsers = [];

    public function setSponsorshipCoupon(?string $sponsorshipCoupon): void
    {
        $this->sponsorshipCoupon = $sponsorshipCoupon;
    }

    public function getSponsorshipCoupon(): ?string
    {
        return $this->sponsorshipCoupon;
    }

    public function setSponsorshipSponsor(?ShopUserInterface $sponsorshipSponsor): void
    {
        $this->sponsorshipSponsor = $sponsorshipSponsor;
    }

    public function getSponsorshipSponsor(): ?ShopUserInterface
    {
        return $this->sponsorshipSponsor;
    }
}
