<?php

namespace Book\ReviewBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Book\ReviewBundle\Entity\Cover;
use Book\ReviewBundle\Form\CoverType;
use Symfony\Component\VarDumper\Cloner\Data;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CoverController extends Controller
{

    public function uploadBookCoverAction($id, Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $book = $em->getRepository('BookReviewBundle:Book')->find($id);
            $cover = new Cover();
            $form = $this->createForm(CoverType::class, $cover ,['action'=>$request->getUri()]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                try {
            $file = $cover->getCover();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('covers_directory'),
                $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $cover->setCover($fileName);
            $cover->setBook($book);
                $em->persist($cover);
                $em->flush();
                 }
                catch  (UniqueConstraintViolationException $e){



                }
                // ... persist the $product variable or any other work
                return $this ->redirectToRoute('book_show', array('id' => $book->getId()));
        }

        return $this->render('@BookReview/Cover/upload_book_cover.html.twig', array(
            'form' => $form->createView(),
            'book' =>$book,
            'cover' =>$cover,

        ));
         }
  }

