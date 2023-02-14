<?php

namespace App\Form;

use App\Entity\Experience;
use App\Entity\Techno;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'experience'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description, taches, roles dans cette expérience'
            ])
            ->add('society', TextType::class, [
                'label' => 'Nom de l\'entreprise'
            ])
            ->add('starting_date', TextType::class, [
                'label' => 'Date de début'
            ])
            ->add('ending_date', TextType::class, [
                'label' => 'Date de fin',
                'attr' => [
                    'placeholder' => '25/03/23 ou maintenant si encours'
                ]
            ])
            ->add('technos', EntityType::class, [
                'label' => 'Choix des technologies utilisées durant cette experience',
                'class' => Techno::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
