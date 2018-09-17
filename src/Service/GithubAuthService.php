<?php

namespace App\Service;


use Exception;
use League\OAuth2\Client\Provider\Github;

class GithubAuthService
{
    /** @var string $clientId */
    private $clientId;

    /** @var string $clientSecret */
    private $clientSecret;

    /** @var string $redirectUrl */
    private $redirectUrl;

    /** @var string $token */
    private $token = null;

    public function __construct(string $clientId, string $clientSecret, string $redirectUrl)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUrl = $redirectUrl;
    }

    public function login()
    {
        $provider = $this->getProvider();

        if (!isset($_GET['code'])) {
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: '.$authUrl);
            exit;

        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            exit('Invalid state');

        } else {
            $this->token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

            try {
                $user = $provider->getResourceOwner($this->token);
            } catch (Exception $e) {

            }

            return $user;
        }
    }

    public function getAccessToken()
    {
        return $this->token;
    }

    public function getProvider()
    {
        return new Github([
            'clientId'          => $this->clientId,
            'clientSecret'      => $this->clientSecret,
            'redirectUri'       => $this->redirectUrl,
        ]);
    }
}