<?php
use Firebase\JWT\JWT;

class StockController {
    public function history($request, $response, $args) {
        $searchTerm = trim($request->getParam('searchId'));
        $userId = $_SESSION['userId'];
        if (!isset($userId)) {
            header("Location: ./../../src/login.php");
            exit();
        }

        $sql = "SELECT * FROM stocks WHERE user_id = :searchTerm OR user_name LIKE :searchTermLike";
        try {
            $db = new db();
            $db = $db->dbConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':searchTerm', $searchTerm, PDO::PARAM_INT);
            $stmt->bindValue(':searchTermLike', "%$searchTerm%", PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $stock = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $response->withJson($stock);                
            } else {
                return $response->withJson("No results found");
            }

            $stmt = null;
            $db = null;              
        } catch (PDOException $e) {
            return $response->withJson([
                'error' => true,
                'message' => $e->getMessage(),
                'error_code' => $e->getCode()
            ]);
        }
    }

    public function stocks($request, $response, $args) {
        $stock_code = trim($request->getParam('searchStock'));

        $userId = isset($_SESSION['userId']);
        if (!isset($_SESSION['userName'])) {
            return $response->withJson([
                'error' => true,
                'message' => 'you must login'
            ]);
        }else{
            $userName = $_SESSION['userName'];
        }
        if (!isset($userId)) {
            header("Location: ./../../src/login.php");
            exit();
        }
        
        $url = "https://stooq.com/q/l/?s={$stock_code}&f=sd2t2ohlcvn&h&e=csv";
        $csv = file_get_contents($url);
        
        $rows = str_getcsv($csv, "\n");
        $cols = str_getcsv($rows[1], ",");
    
        $sql = "INSERT INTO stocks (name, symbol, date, time, open, high, low, close, volume, updated_at, user_id, user_name)
        VALUES (:name, :symbol, :date, :time, :open, :high, :low, :close, :volume, NOW(), :user_id, :user_name)";
    
        try {
            $db = new db();
            $db = $db->dbConnection();
            $result = $db->prepare($sql);
            
            $result->bindParam(':symbol', $stock_code);
            $result->bindParam(':date', $cols[1]);
            $result->bindParam(':time', $cols[2]);
            $result->bindParam(':open', $cols[3]);
            $result->bindParam(':high', $cols[4]);
            $result->bindParam(':low', $cols[5]);
            $result->bindParam(':close', $cols[6]);
            $result->bindParam(':volume', $cols[7]);
            $result->bindParam(':name', $cols[8]);
            $result->bindParam(':user_id', $userId);    
            $result->bindParam(':user_name', $userName);        
    
            if ($cols[7]=="N/D") {
                return $response->withJson([
                    'error' => true,
                    'message' => 'Stock not found'
                ]);
            }
            
            $result->execute();

            $sql = "SELECT * FROM stocks WHERE user_id = $userId";
            try {
                $db = new db();
                $db = $db->dbConnection();
                $result = $db->query($sql);
    
                if ($result->rowcount() > 0) {

                    $result->bindParam(':symbol', $stock_code);
                    $result->bindParam(':date', $cols[1]);
                    $result->bindParam(':time', $cols[2]);
                    $result->bindParam(':open', $cols[3]);
                    $result->bindParam(':high', $cols[4]);
                    $result->bindParam(':low', $cols[5]);
                    $result->bindParam(':close', $cols[6]);
                    $result->bindParam(':volume', $cols[7]);
                    $result->bindParam(':name', $cols[8]);
                    $result->bindParam(':user_id', $userId);    
                    $result->bindParam(':user_name', $userName);    

                    $destino = "gustabin@yahoo.com";
                    $asunto = "This challenge is awesome!.";
                    $cuerpo = "<h2>Requested the quote!</h2>
                    We have received the following information:<br>	
                    <b>Symbol: </b> $stock_code  <br>	
                    <b>Date: </b> $cols[1]<br>	
                    <b>Time: </b> $cols[2]<br>	
                    <b>Open: </b> $cols[3]<br>	
                    <b>High: </b> $cols[4]<br>	
                    <b>Low: </b> $cols[5]<br>	
                    <b>Close: </b> $cols[6]<br>	
                    <b>Volume: </b> $cols[7]<br>	
                    <b>Name: </b> $cols[8]<br>	
                    <b>User_id: </b> $userId<br>	
                    <b>User_name: </b> $userName<br>	
                    <br><br>
                    Jobsite's team<br>
                    <br>
                    <img src=https://www.gustabin.com/img/logoEmpresa.png height=50px width=50px />
                    <a href=https://www.facebook.com/gustabin2.0>
                    <img src=https://www.gustabin.com/img/logoFacebook.jpg alt=Logo Facebook height=50px width=50px></a>
                    <h5>Developed by Eng. Gustavo Arias<br>
                    Copyright © 2021. All rights reserved. Version 1.0.0 <br></h5>
                    ";
                    
                    $yourWebsite = "gustabin.com";
                    $yourEmail = "info@gustabin.com";
                    $cabeceras = "From: $yourWebsite <$yourEmail>\n" . "Reply-To: cuentas@gustabin.com" . "\n" . "Content-type: text/html";
                    
                    mail($destino, $asunto, $cuerpo, $cabeceras);

                    $stock = $result->fetchAll(PDO::FETCH_OBJ);
                    return $response->withJson([
                        'ok' => true,
                        'stock' => $stock,
                        'message' => "Values for {$stock_code} saved"
                    ]);            
                } else {
                    return $response->withJson("This user does not exist in the DB");
                }
    
                $result = null;
                $db = null;
            } catch (PDOException $e) {
                return $response->withJson([
                    'error' => true,
                    'message' => $e->getMessage(),
                    'error_code' => $e->getCode()
                ]);
            }

            $result = null;
            $db = null;
        } catch (PDOException $e) {
            return $response->withJson([
                'error' => true,
                'message' => $e->getMessage(),
                'error_code' => $e->getCode()
            ]);
        }
    }    
}

// This is a PHP file that defines a class called `StockController`. This class has 
// two methods:
// 1. `history($request, $response, $args)`: This method retrieves stock data from a database 
// based on a search term or search term like the user ID. It uses a `db` class to establish a 
// database connection and execute an SQL query. The results are then returned in JSON format.

// 2. `stocks($request, $response, $args)`: This method retrieves stock data from an external 
// website (stooq.com) based on a search term (stock code). It uses the `file_get_contents()` 
// function to retrieve CSV data from the stooq.com website, and then parses the data to extract 
// relevant stock information. It then inserts the data into a database using another SQL query, 
// and sends an email to a specific address with the relevant information.

// This file also includes the `Firebase\JWT\JWT` class, which is used for JSON Web Token 
// authentication. 