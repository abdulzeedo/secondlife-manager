<?php

/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 05/06/2018
 * Time: 11:44
 */

namespace App\Controller;

use App\Model\OAuthEbay;


class ebayloginController extends AppController
{
    /**
     * Get ebay authorization token and then access token
     * Router: * -> index
     */
    public function index() {
        $session = $this->request->getSession();
        $session->start();

        $oauthEbay = new OAuthEbay($session);



        if ($this->request->getQuery("state") == null && $this->request->getQuery("code") == null) {

            $url = $oauthEbay->firstTimeLogin();
            $this->redirect($url);
        }
        else {
           // If the user has already authorised than just get access token and save it
            $code = $this->request->getQuery("code");

            $oauthEbay->getFirstTimeAccessToken($code);
//            //                Something went wrong.
//            if ($response->getStatusCode() != 200) {
//                printf("\nStatus Code: %s\n\n", $response->getStatusCode());
//                printf(
//                    "%s: %s\n\n",
//                    $response->error,
//                    $response->error_description
//                );
//            }
//            printf(
//                "%s\n%s\n%s\n%s\n\n",
//                $response->access_token,
//                $response->token_type,
//                $response->expires_in,
//                $response->refresh_token
//            );
//            $access_token = $response->access_token;
//
//            // Save access and refresh tokens as cookies for now
//            if ($response->access_token != null) {
//                $session->write("access_token", $response->access_token);
//                $session->write("refresh_token", $response->refresh_token);
//                $session->write("refresh_expiry", $response->refresh_token_expires_in + time());
//            }
            debug($_SESSION);

        }
    }


}