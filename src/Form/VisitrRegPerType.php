<?php

namespace App\Form;

use App\Entity\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VisitrRegPerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reg_nom', EntityType::class, array(
                'class' => Region::class,
                'choice_label' => 'reg_nom',
                'multiple' => false,
            ))
            ->add('date_debut',TextType::class ,array())
            ->add('date_fin', TextType::class ,array())

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           // 'data_class' => Region::class,
        ]);
    }
}
