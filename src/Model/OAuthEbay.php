<?php
/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 06/06/2018
 * Time: 16:51
 */

namespace App\Model;
use \DTS\eBaySDK\OAuth\Services;
use \DTS\eBaySDK\OAuth\Types;
use Cake\Core\Configure;

class OAuthEbay extends OConnection
{
    private $service;
    private $session;

    public function __construct($session) {
        // If the session has not yet been started start it
        // Might cause errors in future check back
        if (!$session->started())
                $session->start();
            $this->session = $session;
            $this->service = null;
    }

    /**
     * User needs to login for first time
     * Generate url for login page using its credentials
     * and using a scope as well
     */
    public function firstTimeLogin()
    {
        $this->service = new Services\OAuthService(Configure::read('ebayApiKey')["production"]);
        $url = $this->service->redirectUrlForUser([
            'state' => 'invoice',
            'scope' => [
                'https://api.ebay.com/oauth/api_scope/sell.account',
                'https://api.ebay.com/oauth/api_scope/sell.inventory'
            ]
        ]);

        return $url;
    }

    /**
     * @param $authorization passed from a controller (provided by eBay
     *                       upon successful login)
     * TODO: exception missing
     */
    public function getFirstTimeAccessToken($authorization)
    {
        $this->service = new Services\OAuthService(Configure::read('ebayApiKey')["production"]);
        $response = $this->service->getUserToken(new Types\GetUserTokenRestRequest([
            'code' => $authorization
        ]));

        // If response code is 200
        if ($response->getStatusCode() == 200) {

            $this->session->write("access_token", $response->access_token);
            $this->session->write("refresh_token", $response->refresh_token);
            $this->session->write("refresh_expiry", $response->refresh_token_expires_in + time());
        }
    }

    /**
     * @return String access_token
     * Get new token if the current one has expired
     */
    public function getAccessToken()
    {
        if (time() >= $this->session->read("refresh_expiry"))
            $this->refreshToken();

        $access_token = $this->session->read("access_token");

        return $access_token;
    }

    /**
     * Get new token from eBay when the current is expired
     * TODO: exceptional scenarios to add
     */
    protected function refreshToken()
    {
        // At this point the service might not be in use anywhere
        $this->service = new Services\OAuthService(Configure::read('ebayApiKey')["production"]);

        $response = $this->service->refreshUserToken(new Types\RefreshUserTokenRestRequest([
            'refresh_token' => $this->session->read("refresh_token"),
            'scope' => [
                'https://api.ebay.com/oauth/api_scope/sell.account',
                'https://api.ebay.com/oauth/api_scope/sell.inventory'
            ]
        ]));

        // If response code is 200
        if ($response->getStatusCode() == 200) {

            $this->session->write("access_token", $response->access_token);
            $this->session->write("refresh_token", $response->refresh_token);
            $this->session->write("refresh_expiry", $response->expires_in + time());
        }
    }
}