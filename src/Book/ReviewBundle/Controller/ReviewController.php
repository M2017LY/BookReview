<?php

namespace Book\ReviewBundle\Controller;

use Book\ReviewBundle\Entity\Review;
use Book\ReviewBundle\Form\ReviewType;
use Book\ReviewBundle\Entity\Book;
// use Book\ReviewBundle\Form\BookType;
use Book\ReviewBundle\Entity\Rate;
//use Book\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ReviewController extends Controller
{
    //Lists all book entities.

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reviews = $em->getRepository('BookReviewBundle:Review')->findAll();

        return $this->render('BookReviewBundle:Review:index.html.twig', array(
            'reviews' => $reviews,
        ));
    }

    //Creates a new book entity.

    public function createAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('BookReviewBundle:Book')->find($id);
        $review = new Review();
        $form = $this -> createForm(ReviewType::class, $review,['action'=>$request->getUri()]);
        $form ->handleRequest($request);

        if  ($form->isValid()) {

            $review->setUser($this->getUser());
            $review->setReviewer($this->getUser());
            $review->setBook($book);
            $review->setTimestamp(new \DateTime());

            $em->persist($review);
            $em->flush();

            return $this ->redirectToRoute('book_show', array('id' => $book->getId()));
        }

        return $this->render('BookReviewBundle:Review:create.html.twig', array(
            'book' =>$book,
            'review' =>$review,
            'form'=> $form->createView(),
        ));
    }


    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('BookReviewBundle:Review')->find($id);

        dump ($review);
// Pass the book entity to the view for displaying
        return $this->render('BookReviewBundle:Review:show.html.twig',
            ['review' => $review]);
    }


    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('BookReviewBundle:Review')->find($id);
        $form = $this->createForm(ReviewType::class, $review, [
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('review_show',
                ['id' => $review->getId()]));
        }

        return $this->render('BookReviewBundle:Review:edit.html.twig',
            ['form' => $form->createView(),
                'review' => $review]);
    }

    // Deletes a review entry.

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('BookReviewBundle:Review')->find($id);

        $em->remove($review);
        $em->flush();

        return $this->redirect($this->generateUrl('book_index'));
    }

   }
