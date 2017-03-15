<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('adresse')->add('responsable')->add('telephone')->add('mail')->add('prixPersonne')->add('reduction')
            ->add('Ville', EntityType::class, array(
                'class'        => 'AppBundle\Entity\Ville',
                'choice_label' => 'Nom',
                'multiple'     => false))
            ->add('Categories', EntityType::class, array(
                'class'        => 'AppBundle\Entity\Categorie',
                'choice_label' => 'Nom',
                'multiple'     => true,
                'expanded'     => true))
            ->add("Enregister",SubmitType::class,["attr"=>["class"=>"btn btn-success"]]);;;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Activite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_activite';
    }


}
