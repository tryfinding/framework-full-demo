<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'plugin\\' => array($baseDir . '/plugins'),
    'core\\' => array($baseDir . '/system/lib'),
    'app\\' => array($baseDir . '/app'),
    'Violin\\' => array($vendorDir . '/alexgarrett/violin/src'),
    'Symfony\\Component\\Yaml\\' => array($vendorDir . '/symfony/yaml'),
    'Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-message/src'),
    'League\\OAuth2\\Client\\' => array($vendorDir . '/league/oauth2-client/src'),
    'GuzzleHttp\\Psr7\\' => array($vendorDir . '/guzzlehttp/psr7/src'),
    'GuzzleHttp\\Promise\\' => array($vendorDir . '/guzzlehttp/promises/src'),
    'GuzzleHttp\\' => array($vendorDir . '/guzzlehttp/guzzle/src'),
);
