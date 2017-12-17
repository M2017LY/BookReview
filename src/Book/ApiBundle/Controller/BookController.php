<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 18/12/16
 * Time: 21:25
 */

namespace Book\ApiBundle\Controller;


use Book\ReviewBundle\Entity\Book;
use Book\ReviewBundle\Form\BookType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class BookController extends FOSRestController
{
    public function getBooksAction()
    {
        $em= $this->getDoctrine()->getManager();
        $books= $em->getRepository('BookReviewBundle:Book')->findAll();
        return $this->handleView($this->view($books));
    }

    public function getBookAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('BookReviewBundle:Book')->find($id);
        if(!$book) {
// no book entry is found, so we set the view
// to no content and set the status code to 404
            $view = $this->view(null, 404);
        }
        else {
// the blog entry exists, so we pass it to the view
// and the status code defaults to 200 "OK"
            $view = $this->view($book);
        }
        return $this->handleView($view);
    }


    public function postBookAction(Request $request)
    {
// prepare the form and remove the submit button
        $book = new Book();
        $form = $this->createForm(BookType::class, $book,
        ['csrf_protection' => false, ]);
// Point 1 of list above
        if($request->getContentType() != 'json') {
            return $this->handleView($this->view(null, 400));
        }
// json_decode the request content and pass it to the form
        $form->submit(json_decode($request->getContent(), true));
// Point 2 of list above
        if($form->isValid()) {
// Point 4 of list above
            $em = $this->getDoctrine()->getManager();
            $book->setUser($this->getUser());
            $book->setTimestamp(new \DateTime());
            $em->persist($book);
            $em->flush();
// set status code to 201 and set the Location header
// to the URL to retrieve the blog entry - Point 5
            return $this->handleView($this->view(null, 201)
                ->setLocation(
                    $this->generateUrl('api_book_get_book',
                        ['id' => $book->getId()]
                    )
                )
            );
        } else {
// the form isn't valid so return the form
// along with a 400 status code
            return $this->handleView($this->view($form, 400));
        }
    }

    public function deleteBookAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('BookReviewBundle:Book')->find($id);
        if ($book == null) {
            return $this->handleView($this->view(null, 404));
        }
        $em->remove($book);
        $em->flush();
        return $this->handleView($this->view(null, 204));
    }

    public function putBooksAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /**
         * @var \Book\ReviewBundle\Entity\Book $book
         */
        $book = $em->getRepository('BookReviewBundle:Book')->find($id);
        if ($book == null) {
            return $this->handleView($this->view(null, 404));
        }
        $form = $this->createForm(new BookType(), $book);
        if ($request->getContentType() != 'json') {
            return $this->handleView($this->view(null, 400));
        }
        $form->submit(json_decode($request->getContent(), true), true);
        if ($form->isValid()) {
            $em->flush();
            return $this->handleView($this->view(null, 204));
        } else {
            $this->handleView($this->view($form, 400));

        }
    }

}