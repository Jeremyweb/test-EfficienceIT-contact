<?php

namespace App\Form;

use App\Entity\Department;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add ('firstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add ('mail', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Entrez votre Email'
                ]
            ])
            ->add('message', TextAreaType::class, [
                'label' => 'Message',
                'attr' =>[
                    'placeholder' => 'Entrez votre message'
                ]
            ])
            ->add('department', ChoiceType::class, [
                'label' => 'Département',
                'choices' => [
                    'direction' => 'Direction',
                    'human ressources' => 'Ressources humaine',
                    'communications service' => 'Communication',
                    'development' => 'Développement'
                ]

            //Je souhaitez intégrer un EntityTye pour y mettre les données de mon entité Department (mais je n'arrive pas a l'utiliser).
            //->add('department', EntityType::class, [
            //    'class' => Department::class,
            //    'choice_label' => 'name'

            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-info'
                ]

    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
