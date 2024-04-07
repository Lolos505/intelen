<?php

namespace App\Form;

use App\Entity\BookAuthor;
use App\Entity\Book;
use App\Entity\Author;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Import the EntityType
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookAuthor1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('book', EntityType::class, [
                // Specify which entity this field is for
                'class' => Book::class,
                // Define how to display each option (use the 'title' property of the Book entity)
                'choice_label' => 'title',
            ])
            ->add('author', EntityType::class, [
                // Specify which entity this field is for
                'class' => Author::class,
                // Use a callback to define how to display each option
                // Here, combining the first name and last name of the Author
                'choice_label' => function (Author $author) {
                    return $author->getFirstName() . ' ' . $author->getLastName();
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookAuthor::class,
        ]);
    }
}
