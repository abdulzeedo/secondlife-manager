<?php
use Cake\Routing\Router;

Router::plugin(
    'CakeApiBaselayer',
    ['path' => '/scherersoftware/cake-api-baselayer'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
