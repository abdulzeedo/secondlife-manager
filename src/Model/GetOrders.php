<?php
namespace App\Model;

use Cake\Core\Configure;
use Cake\Error\Debugger;
use \DTS\eBaySDK\OAuth\Services;

//require_once(ROOT.'vendor'.DS.'dts'.DS.'ebay-sdk-php'.DS.'src'.);

/**
 * Implements the logic to retrieve orders information from eBay 
 * using eBay/DTS library api
 * @author abdulzeedo
 *
 */
class GetOrders {
    
    
    public function __constructor() {
        
    }
    public function debug() {
        $service = new Services\OAuthService(Configure::read('ebayAPIKey')["production"]);
        
        $response = $service->getAppToken();
        Debugger::dump("hei ");
        print_r("\nStatus Code: %s\n\n", $response->getStatusCode());
        if ($response->getStatusCode() !== 200) {
            Debugger::dump(
                "%s: %s\n\n",
                $response->error,
                $response->error_description
                );
            return false;
        } else {
            print_r(
                "%s\n%s\n%s\n\n",
                $response->access_token,
                $response->token_type,
                $response->expires_in
                );
            return true;
        } // else
            return true;
    }
}