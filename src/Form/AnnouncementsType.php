<?php

namespace App\Form;

use App\Entity\Announcements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titel', TextType::class)
            ->add('inhoud', TextType::class)
            ->add('rol', ChoiceType::class, [
                'choices' => [
                    'Docent' => 'Docent',
                    'Leerling' => 'Leerling',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announcements::class,
        ]);
    }
}
