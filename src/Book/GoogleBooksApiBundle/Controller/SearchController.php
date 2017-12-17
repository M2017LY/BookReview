<?php

namespace Book\GoogleBooksApiBundle\Controller;

use Book\GoogleBooksApiBundle\Entity\Search;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


/**
 * Search controller.
 *
 */
class SearchController extends Controller
{
    /**
     * Lists all search entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $searches = $em->getRepository('BookGoogleBooksApiBundle:Search')->findAll();

        return $this->render('search/index.html.twig', array(
            'searches' => $searches,
        ));
    }

    /**
     * Creates a new search entity.
     *
     */
    public function newAction(Request $request)
    {

        $search = new Search();
        $form = $this->createForm('Book\GoogleBooksApiBundle\Form\SearchType', $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($search);
            $em->flush($search);

            return $this->redirectToRoute('Google_edit', array('id' => $search->getId()));
        }

        return $this->render('search/new.html.twig', array(
            'search' => $search,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a search entity.
     *
     */
    public function showAction(Search $search)
    {
        $deleteForm = $this->createDeleteForm($search);

        return $this->render('search/show.html.twig', array(
            'search' => $search,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing search entity.
     *
     */
    public function editAction( Request $request, Search $search)
    {
        $error = false;
        $guzzleClient = new Client();
        $response = $guzzleClient ->get ('https://www.googleapis.com/books/v1/volumes?q=' . $search ->getQuery());
        $data = $response->getBody();
        $decodedData = \GuzzleHttp\json_decode($data, true);

        $deleteForm = $this->createDeleteForm($search);
        $editForm = $this->createForm('Book\GoogleBooksApiBundle\Form\SearchType', $search);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager();

            return $this->redirectToRoute('Google_edit', array('id' => $search->getId()));
        }

        return $this->render('search/edit.html.twig', array(
            'search' => $search,
            'query' => $decodedData,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error'=>$error,
        ));
    }

    /**
     * Deletes a search entity.
     *
     */
    public function deleteAction(Request $request, Search $search)
    {
        $form = $this->createDeleteForm($search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($search);
            $em->flush($search);
        }

        return $this->redirectToRoute('Google_index');
    }

    /**
     * Creates a form to delete a search entity.
     *
     * @param Search $search The search entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Search $search)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Google_delete', array('id' => $search->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
