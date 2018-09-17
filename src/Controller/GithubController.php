<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\GithubAuthService;
use Doctrine\ORM\EntityManager;
use Github\ApiToken;
use Github\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class GithubController extends Controller
{
    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/github")
     * @param GithubAuthService $service
     * @param EntityManager $entityManager
     * @return
     */
    public function connectAction(GithubAuthService $service)
    {
        $user = $service->login();

        $token = new ApiToken($service->getAccessToken());
        $client = new Client($token);

        $test = $client->user()->events($user->getNickname());


//        $test = new Token

        return 2;
    }

    public function createUser(EntityManager $entityManager)
    {
        $user = new User();
        $user->setUsername($user['login']);
        $user->setEmail($user['email']);
    }
}
