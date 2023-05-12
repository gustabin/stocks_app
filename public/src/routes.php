<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Firebase\JWT\JWT;
$app = new \Slim\App;

session_start();

// Clave secreta para firmar los tokens
define('JWT_SECRET', 'mi_clave_secreta');

require __DIR__ . './../controllers/UserController.php';
require __DIR__ . './../controllers/StockController.php';
$userController = new UserController();
$stockController = new StockController();

// Login
$app->post('/api/user/login', [$userController, 'login']);

// POST create new user
$app->post('/api/user/create', [$userController, 'create']);

// POST verify token
$app->get('/api/user/verify', [$userController, 'verify']);

// Get -> POST history
$app->post('/api/history/', [$stockController, 'history']);

// GET --> POST stooq stock quote online            
$app->post('/api/stocks/', [$stockController, 'stocks']);
// $app->post('/api/user/login2', [$stockController, 'stocks']);

$app->get('/', function (Request $request, Response $response) {
    return $response->withRedirect('/src/stocks.php');
});

$app->get('/src/', function (Request $request, Response $response) {
    return $response->withRedirect('/src/stocks.php');
});

$app->get('/app/', function (Request $request, Response $response) {
    return $response->withRedirect('/src/stocks.php');
});
// This is a PHP file that defines routes for a Slim application. It starts by importing 
// classes for handling HTTP requests and responses, as well as the Firebase JWT library 
// for working with JSON Web Tokens. Then, it creates a new Slim application instance 
// and starts a session.

// The file requires two controller classes: UserController and StockController, which 
// define methods for handling various HTTP requests. The UserController methods handle 
// user authentication and creation, while the StockController methods handle retrieving 
// stock quotes and historical data.

// The routes defined in this file include:

// - `/api/user/login`: A POST route for logging in a user.
// - `/api/user/create`: A POST route for creating a new user.
// - `/api/user/verify`: A GET route for verifying a JSON Web Token.
// - `/api/history/{userId}`: A POST route for retrieving historical stock data for a given user.
// - `/api/stocks/{searchStock}`: A POST route for retrieving stock quotes for a given stock symbol.

// In addition to these API routes, there are also three routes for redirecting to the main 
// application page (`/`), the source code directory (`/src/`), and an application directory (`/app/`).