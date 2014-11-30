<?php
//mise en place de l'autoloader de Composer
require_once __DIR__.'/../vendor/autoload.php';

$app = new App\AppEchyzen();

// Please set to false in a production environment
$app['debug'] = true;

$app->run();