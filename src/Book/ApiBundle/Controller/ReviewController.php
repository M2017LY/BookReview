<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 18/12/16
 * Time: 18:34
 */

namespace Book\ApiBundle\Controller;

use Book\ReviewBundle\Entity\Book;
use Book\ReviewBundle\Entity\Review;
use Book\ReviewBundle\Form\BookType;
use Book\ReviewBundle\Form\ReviewType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class ReviewController extends FOSRestController
{
       public function postBookReviewAction(Request $request)
    {
// prepare the form and remove the submit button
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review,
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


            $review->setUser($this->getUser());
            $review->setTimestamp(new \DateTime());
            $em->persist($review);
            $em->flush();
// set status code to 201 and set the Location header
// to the URL to retrieve the blog entry - Point 5
            return $this->handleView($this->view(null, 201)
                ->setLocation(
                    $this->generateUrl('api_review_post_book_review',
                        ['id' => $review->getId()]
                    )
                )
            );
        } else {
// the form isn't valid so return the form
// along with a 400 status code
            return $this->handleView($this->view($form, 400));
        }
    }

    public function deleteBookReviewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('BookReviewBundle:Review')->find($id);
        if ($review == null) {
            return $this->handleView($this->view(null, 404));
        }
        $em->remove($review);
        $em->flush();
        return $this->handleView($this->view(null, 204));
    }

    public function putBookReviewsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /**
         * @var \Book\ReviewBundle\Entity\Book $review
         */
        $review = $em->getRepository('BookReviewBundle:Review')->find($id);
        if ($review == null) {
            return $this->handleView($this->view(null, 404));
        }
        $form = $this->createForm(new ReviewType(), $review);
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