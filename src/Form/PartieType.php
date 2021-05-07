<?php

namespace App\Form;

use App\Entity\Partie;
use App\Entity\Client;
use App\Entity\Salle;
use App\Entity\PositionObstacle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jour')
            ->add('nbJoueurs')
            ->add('nbObstacles')
            ->add('reussite')
            ->add('client',EntityType::class, [
                'class' => Client::class,
                'label' => 'Le client',
                'choice_label' => 'id'
            ])
            ->add('salle', EntityType::class, [
                'class' => Salle::class,
                'label' => 'La salle',
                'choice_label' => 'id'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partie::class,
        ]);
    }
}
