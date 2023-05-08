<?php

declare(strict_types=1);

namespace Acme\SyliusSponsorshipPlugin\Form;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class SponsorType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('code', TextType::class, [
                'label' => 'sylius_sponsorship_plugin.ui.coupon',
                'mapped' => false,
                'required' => false,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'sponsor';
    }
}
