<?php
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

class db{        
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;

    public function __construct() {
        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbUser = $_ENV['DB_USER'];
        $this->dbPass = $_ENV['DB_PASS'];
        $this->dbName = $_ENV['DB_NAME'];
    }

    //Connection
    public function dbConnection(){
        $mysqlConnect = "mysql:host=$this->dbHost; dbname=$this->dbName";
        $pdo = new PDO($mysqlConnect, $this->dbUser, $this->dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}

// This file defines a PHP class named `db` that handles the database 
// connection for the application. It contains private properties for the 
// database host, username, password, and database name. The `dbConnection` 
// method creates a PDO object to establish a connection to the database 
// using the values of the private properties, and sets an error mode to 
// throw exceptions if any errors occur during the execution of the SQL 
// statements. Finally, it returns the PDO object to the calling function. 