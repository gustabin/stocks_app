<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require (__DIR__ . '/vendor/autoload.php');
require_once (__DIR__ . '/config/db.php');

$app = new \Slim\App;
require (__DIR__ . '/src/routes.php');

$app->run();

// The `index.php` file is the entry point of a Slim Framework web application. 
// It starts by loading the required dependencies through `vendor/autoload.php` 
// and the database configuration through `config/db.php`. Then, it creates a 
// new instance of the Slim application and registers the application routes 
// defined in `src/routes.php`. Finally, it runs the Slim application with `$app->run()`.