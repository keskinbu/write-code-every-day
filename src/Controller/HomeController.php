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
//        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $token = new ApiToken('ac9ce13d9a3cd7251792e685334caecf82766152');
        $client = new Client($token);

        $events = $client->user()->events('keskinbu');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
