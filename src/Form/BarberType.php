<?php

namespace App\Form;

use App\Entity\Barber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BarberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Shop Name / Your Name',
                'attr' => ['placeholder' => 'e.g., The Cutting Edge'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Shop Email',
                'attr' => ['placeholder' => 'contact@yourshop.com'],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone Number',
                'attr' => ['placeholder' => '+1 555 123 4567'],
            ])
            ->add('location', TextType::class, [
                'label' => 'Shop Location/Address',
                'attr' => ['placeholder' => '123 Main Street, City'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Barber::class,
        ]);
    }
}