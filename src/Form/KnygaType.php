<?php

namespace App\Form;

use App\Entity\Autorius;
use App\Entity\Knyga;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class KnygaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pavadinimas', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ]
            ])
            ->add('isleidimoMetai', DateType::class, [
                'years' => range(date('Y') - 100, date('Y')),
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('isbn', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('autorius', EntityType::class, [
                'class' => Autorius::class,
                'choice_label' => 'vardas',
                'constraints' => [
                    new NotBlank([], 'Pasirinkite autorių.'),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Knyga::class,
        ]);
    }
}
