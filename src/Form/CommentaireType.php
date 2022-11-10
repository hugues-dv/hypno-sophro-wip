<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', TextareaType::class)
            ->add('prenom')
            ->add('nom')
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Sophrologie' => 'Sophrologie',
                    'Hypnose' => 'Hypnose',
                    'autre' => 'autre'
                    ]
            ])
            ->add('note', ChoiceType::class,[
                'choices' => range(0,5,1)
            ])
            // ->add('date_creation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
