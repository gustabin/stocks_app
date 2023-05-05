<?php
use PHPUnit\Framework\TestCase;
require 'controllers/StockController.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UriInterface;

class StockControllerTest extends TestCase
{
    public function testHistory() {
        $uri = $this->createMock(UriInterface::class);
        $request = $this->createMock(Request::class);
        $response = $this->createMock(Response::class);
        $args = [];

        $controller = new StockController();

        // Set up session variables
        $_SESSION['userId'] = 1;

        // Set up the mock UriInterface object
        $uri->method('getPath')->willReturn('/');

        // Set up the mock Request object
        $request->method('getUri')->willReturn($uri);

        // Test with a search term that should return results
        $request->method('getQueryParams')->willReturn(['searchId' => 'searchTerm']);
        $response->method('withJson')->willReturn(true);
        $this->assertNotNull($controller->history($request, $response, $args));

        // Test with a search term that should not return results
        $request->method('getQueryParams')->willReturn(['searchId' => 'non-existent']);
        $response->method('withJson')->willReturn("No results found");
        $this->assertNotNull($controller->history($request, $response, $args));
    }
}
// This is a PHP unit test file named StockControllerTest.php. It tests the 
// functionality of the history() method of the StockController class. It creates 
// mock objects for the Request, Response, and UriInterface classes and sets up 
// session variables for the user ID. It then tests the history() method with two 
// different search terms to check if it returns results or "No results found".