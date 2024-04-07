<?php

namespace App\Controller;

use App\Entity\BookAuthor;
use App\Form\BookAuthor1Type;
use App\Repository\BookAuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book/author')]
class BookAuthorController extends AbstractController
{
    #[Route('/', name: 'app_book_author_index', methods: ['GET'])]
    public function index(BookAuthorRepository $bookAuthorRepository): Response
    {
        return $this->render('book_author/index.html.twig', [
            'book_authors' => $bookAuthorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_book_author_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bookAuthor = new BookAuthor();
        $form = $this->createForm(BookAuthor1Type::class, $bookAuthor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bookAuthor);
            $entityManager->flush();

            return $this->redirectToRoute('app_book_author_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('book_author/new.html.twig', [
            'book_author' => $bookAuthor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_book_author_show', methods: ['GET'])]
    public function show(BookAuthor $bookAuthor): Response
    {
        return $this->render('book_author/show.html.twig', [
            'book_author' => $bookAuthor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_book_author_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BookAuthor $bookAuthor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookAuthor1Type::class, $bookAuthor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_book_author_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('book_author/edit.html.twig', [
            'book_author' => $bookAuthor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_book_author_delete', methods: ['POST'])]
    public function delete(Request $request, BookAuthor $bookAuthor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $bookAuthor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bookAuthor);
            $entityManager->flush();

            $this->addFlash('success', 'The relationship was successfully deleted.');
        }

        return $this->redirectToRoute('app_book_author_index');
    }
}
