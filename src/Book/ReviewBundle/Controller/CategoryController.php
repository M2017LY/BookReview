<?php

namespace Book\ReviewBundle\Controller;

use Book\ReviewBundle\Entity\Category;
use Book\ReviewBundle\Form\CategoryType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{

    //Creates a new category entity.
    public function createAction(Request $request)
    {
        $category = new Category();
        $form = $this -> createForm(CategoryType::class, $category,['action'=>$request->getUri()]);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            try {
            $em->persist($category);
            $em->flush();
            return $this ->redirectToRoute('category_show', array('id' => $category->getId()));
        }

    catch (UniqueConstraintViolationException $e){
        /////
    }


        }
        return $this->render('BookReviewBundle:Category:create.html.twig', array(
            'category' =>$category,
            'form'=> $form->createView(),
        ));
    }

    //Lists all category entities.
        public function indexAction()
        {
            $em = $this->getDoctrine()->getManager();
            $category = $em->getRepository('BookReviewBundle:Category')->findAll();

            return $this->render('@BookReview/Category/index.html.twig', array(
                'categories' => $category,
            ));
        }

    //Finds and displays a category entity.

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('BookReviewBundle:Category')->find($id);
// Pass the book entity to the view for displaying
        return $this->render('BookReviewBundle:Category:show.html.twig',
            ['category' => $category]);
    }


// Displays a form to edit an existing category entity.

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('BookReviewBundle:Category')->find($id);
        $form = $this->createForm(CategoryType::class, $category, [
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('category_show',
                ['id' => $category->getId()]));
        }

        return $this->render('BookReviewBundle:Category:edit.html.twig',
            ['form' => $form->createView(),
                'category' => $category]);
    }

// Deletes a category entity.

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('BookReviewBundle:Category')->find($id);

        try{
                $em->remove($category);
                $em->flush();
                return $this->redirect($this->generateUrl('category_index'));
            }
        catch (\Exception $exception){

            }
        return $this->redirect($this->generateUrl('category_index'));
    }
}
