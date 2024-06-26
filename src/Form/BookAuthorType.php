<?php

namespace App\Form;

use App\Entity\BookAuthor;
use App\Entity\Book;
use App\Entity\Author;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookAuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'title',
                // Optionally, add 'choice_label' to display the book's title in the dropdown
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => function (Author $author) {
                    return $author->getFirstName() . ' ' . $author->getLastName();
                    // This callback combines the author's first name and last name for display
                },
                // Optionally, if authors have a method that returns their full name, you could use:
                // 'choice_label' => 'fullNameMethod',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookAuthor::class,
        ]);
    }
}
