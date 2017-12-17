<?php

namespace Book\ReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Book\ReviewBundle\Entity\Book;
use Book\ReviewBundle\Form\BookType;

class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('BookReviewBundle:Book')
            ->getLatest(10, 0);
        return $this->render('BookReviewBundle:Page:index.html.twig',
            ['books' => $books]);

    }

    public function aboutAction()
    {
        return $this->render('BookReviewBundle:Page:about.html.twig', array(
            // ...
        ));
    }

    public function apiAction()
    {
        return $this->render('BookReviewBundle:Page:api.html.twig', array(
            // ...
        ));
    }


    public function searchAction($categoryId)
        {
            $category = $this->getDoctrine()
                ->getRepository('BookReviewBundle:Category')
                ->find($categoryId);
            $book = $category->getProducts();

        return $this->render('BookReviewBundle:Page:index.html.twig', array(
            'book'=> $book,
            'category' => $category,
        ));
    }



}
