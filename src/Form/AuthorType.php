<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Import the EntityType
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('yearOfBirth')
            ->add('country', EntityType::class, [ // Specify that this is an EntityType
                'class' => Country::class, // Specify the class of the entity to use
                'choice_label' => 'name', // Specify which property of the Country entity to display
                // Optionally, add 'required' => false if the country is not a required field
            ])
            ->add('telephone')
            ->add('email');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
