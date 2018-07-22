<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'Bootstrap' => $baseDir . '/vendor/holt59/cakephp3-bootstrap-helpers/',
        'CakeApiBaselayer' => $baseDir . '/vendor/scherersoftware/cake-api-baselayer/',
        'CkTools' => $baseDir . '/vendor/codekanzlei/cake-cktools/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'FrontendBridge' => $baseDir . '/vendor/codekanzlei/cake-frontend-bridge/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Search' => $baseDir . '/vendor/friendsofcake/search/',
        'WyriHaximus/TwigView' => $baseDir . '/vendor/wyrihaximus/twig-view/'
    ]
];