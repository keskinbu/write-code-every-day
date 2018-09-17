<?php

namespace App\Controller;

use Github\ApiToken;
use Github\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return new JsonResponse();
        $token = new ApiToken();
        $client = new Client($token);

        return new JsonResponse(json_decode($client->user()->events('keskinbu'), true));


//        return $this->render('home/index.html.twig', [
//            'controller_name' => 'HomeController',
//        ]);
    }
}
