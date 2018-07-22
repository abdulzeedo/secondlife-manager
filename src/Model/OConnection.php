<?php
/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 06/06/2018
 * Time: 16:48
 */

namespace App\Model;


abstract class OConnection
{
    abstract protected function refreshToken();
    abstract public function firstTimeLogin();
    abstract public function getAccessToken();
    abstract public function getFirstTimeAccessToken($authorization);

}