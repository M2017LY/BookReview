<?php

namespace Book\GoogleBooksApiBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GuzzleHttp\Client;

class GoogleApiController extends Controller
{

 public function indexAction()
    {
        $error = false;
        $guzzleClient = new Client();
        $response = $guzzleClient ->get ('https://www.googleapis.com/books/v1/volumes?q=php ');
        $data = $response->getBody();
        $decodedData = \GuzzleHttp\json_decode($data, true);
        return $this->render('BookGoogleBooksApiBundle:GoogleApiController:index.html.twig', array(
            'rawData' => $decodedData,
            'error'=>$error,

        ));
    }
 }
