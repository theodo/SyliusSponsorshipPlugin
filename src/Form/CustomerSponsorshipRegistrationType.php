<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Form;

use Sylius\Bundle\CoreBundle\Form\Type\Customer\CustomerRegistrationType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerSponsorshipRegistrationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('sponsor', SponsorType::class, [
                'label' => 'sylius.form.customer.first_name',
                'mapped' => false,
            ])
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
