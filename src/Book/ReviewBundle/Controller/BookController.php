<?php

namespace Book\ReviewBundle\Controller;

use Book\ReviewBundle\Form\BookType;
use Book\ReviewBundle\Entity\Book;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    //Lists all book entities.

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('BookReviewBundle:Book')->findAll();
        return $this->render('@BookReview/Book/index.html.twig', array(
            'books' => $books,
        ));
    }

    //Creates a new book entity.

    public function createAction(Request $request)
    {
        $book = new Book();
        $form = $this -> createForm(BookType::class, $book,['action'=>$request->getUri()]);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();

            try {

                $book->setUser($this->getUser());
                $book->setTimestamp(new \DateTime());
                $em->persist($book);
                //if (isset($book)) {
                    $em->flush();
                    return $this->redirectToRoute('book_show', array('id' => $book->getId()));
                //}
                }
            catch (UniqueConstraintViolationException $e){
                ////
            }
        }
        return $this->render('BookReviewBundle:Book:create.html.twig', array(
            'book' =>$book,
            'form'=> $form->createView(),
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
       $book = $em->getRepository('BookReviewBundle:Book')->find($id);
// Pass the book entity to the view for displaying
        return $this->render('BookReviewBundle:Book:show.html.twig',
           ['book' => $book]);
    }


// Displays a form to edit an existing book entity.

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('BookReviewBundle:Book')->find($id);
        $form = $this->createForm(BookType::class, $book, [
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('book_show',
                ['id' => $book->getId()]));
        }

        return $this->render('BookReviewBundle:Book:edit.html.twig',
            ['form' => $form->createView(),
                'book' => $book]);
    }

// Deletes a book entity.
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('BookReviewBundle:Book')->find($id);
        $em->remove($book);
        $em->flush();
        return $this->redirect($this->generateUrl('book_index'));
    }
}

