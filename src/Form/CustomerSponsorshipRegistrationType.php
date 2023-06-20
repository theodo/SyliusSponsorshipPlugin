<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Form;

use App\Entity\User\ShopUser;
use Sylius\Bundle\CoreBundle\Form\Type\Customer\CustomerRegistrationType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Core\Model\Customer;
use Sylius\Component\User\Repository\UserRepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class CustomerSponsorshipRegistrationType extends AbstractResourceType
{
    public function __construct(
        protected string $dataClass,
        protected array $validationGroups = [],
        protected string $repositoryName,
        private UserRepositoryInterface $shopUserRepository
    )
    {
        parent::__construct($dataClass, $validationGroups);
    }
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('sponsor', SponsorType::class, [
                'label' => 'sylius.form.customer.first_name',
                'mapped' => false,
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {
                $form = $event->getForm();
                /** @var Customer $customer */
                $customer = $event->getData();
                /** @var ShopUser $user */
                $user = $customer->getUser();

                $sponsorCode = $form->get('sponsor')->get('code')->getData();

                if ($sponsorCode !== null) {
                    $sponsor = $this->shopUserRepository->findOneBy(["sponsorshipCoupon" => $sponsorCode]);
                    $user->setSponsorshipSponsor($sponsor);
                }
            })
        ;
    }

    public function getParent(): string
    {
        return CustomerRegistrationType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'sylius_customer_registration';
    }
}
