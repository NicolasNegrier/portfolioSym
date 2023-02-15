<?php

namespace App\Form;

use App\Entity\Experience;
use App\Entity\Project;
use App\Entity\Techno;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TechnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du language / techno / outil'
            ])
            ->add('logo', FileType::class, [
                'label' => 'Logo',
                'required' => false
            ])
            ->add('projects', EntityType::class, [
                'label' => 'Choix des projets l\'utilisant',
                'class' => Project::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('experiences', EntityType::class, [
                'label' => 'Choix des expériences l\'utilisant',
                'class' => Experience::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Techno::class,
        ]);
    }
}
