<?php
use Firebase\JWT\JWT;

class UserController {
    public function login($request, $response, $args) {
        $_SESSION['userId']="";
        $email = $request->getParam('email');
        $password = $request->getParam('password');       

        $sql = "SELECT * FROM users WHERE email = :email";
        try {
            $db = new db();
            $db = $db->dbConnection();
            $result = $db->prepare($sql);

            $result->bindParam(':email', $email);
          
            $result->execute();
            $user = $result->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                return $response->withJson([
                    'error' => true,
                    'message' => 'Invalid email or password'
                ]);
            }

            $userId = $user['id'];
            $name = $user['name'];
            $stored_hash = $user['password'];           

            if(password_verify($password, $stored_hash)){
                $expire = time() + 3600;  // 1 hour
                  
                // Payload
                $payload = array(
                    'jti' => base64_encode(random_bytes(32)),
                    'name' => $name,
                    "email" => $email,
                    'exp' => $expire                      
                );
    
                $token = JWT::encode($payload, JWT_SECRET);
                $sql = "UPDATE users SET remember_token = '$token' WHERE id = :userId";
                try {
                    $db = new db();
                    $db = $db->dbConnection();
                    $result = $db->prepare($sql);
                    $result->bindParam(':userId', $userId);
                    $result->execute();                    

                    $_SESSION['token'] = $token;
                    $_SESSION['userId'] = $userId;        
                    $_SESSION['userName'] = $name;   

                    $response = $response->withHeader('Authorization', 'Bearer ' . $token);
                    $response = $response->withJson(['token' => $token, 'expire' => $expire, 'ok' => true]);
                    return $response;    

                } catch (PDOException $e) {
                    return $response->withJson([
                        'error' => true,
                        'message' => $e->getMessage(),
                        'error_code' => $e->getCode()
                    ]);
                }
            } else {
                return $response->withJson([
                    'error' => true,
                    'message' => 'Invalid email or password'
                ]);
            }
        } catch (PDOException $e) {
            return $response->withJson([
                'error' => true,
                'message' => $e->getMessage(),
                'error_code' => $e->getCode()
            ]);
        }
    }

    public function create($request, $response, $args) {
        $name = $request->getParam('name');
        $email = $request->getParam('email');
        $password = $request->getParam('password');
        
        $sql = "INSERT INTO users (name, email, password, created_at, remember_token) VALUES
                (:name, :email, :password, NOW(), :token)";
        try {
            $db = new db();
            $db = $db->dbConnection();
            $result = $db->prepare($sql);    
            
            $expire = time() + 3600;  // 1 hour
            // Payload
            $payload = array(
                'jti' => base64_encode(random_bytes(32)),
                'name' => $name,
                "email" => $email,
                'exp' => $expire                      
            );
    
            $token = JWT::encode($payload, JWT_SECRET);

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $result->bindParam(':name', $name);
            $result->bindParam(':email', $email);
            $result->bindParam(':password', $password_hash);
            $result->bindParam(':token', $token);
    
            $result->execute();
    
            $result = null;
            $db = null;
    
            return $response
            ->withHeader('Authorization', "Bearer $token")
            ->withJson([
                'token' => $token,
                'expire' => $expire,
                'message' => "New user saved",
                'ok' => true
            ]);
        } catch (PDOException $e) {
            return $response->withJson([
                'error' => true,
                'message' => $e->getMessage(),
                'error_code' => $e->getCode()
            ]);
        }
    }

    public function verify($request, $response, $args) {
        $headers = apache_request_headers();
        $authorization_header = isset($headers['Authorization']) ? $headers['Authorization'] : '';
        list($token) = sscanf($authorization_header, 'Bearer %s');    
        
        if ($token) {
            $sql = "SELECT * FROM users WHERE remember_token = :remember_token";

            try {
                $db = new db();
                $db = $db->dbConnection();
                $result = $db->prepare($sql);    
                $result->bindParam(':remember_token', $token);
                $result->execute();
                $user = $result->fetch(PDO::FETCH_ASSOC);
        
                $result = null;
                $db = null;

                if (!$user) {
                    return $response->withJson([
                        'error' => true,
                        'message' => 'Invalid token'
                    ]);
                } else {
                    $name = $user['name'];
                    return $response
                    ->withJson([                
                        'ok' => true,
                        'name' => $name
                    ]);
                }
            } catch (PDOException $e) {
                return $response->withJson([
                    'error' => true,
                    'message' => $e->getMessage(),
                    'error_code' => $e->getCode()
                ]);
            }
        }
    }
}

// This is a PHP file that defines a class `UserController` with three methods: 
// `login()`, `create()`, and `verify()`. 

// The `login()` method receives an email and a password, queries a database for a user 
// with the given email, and verifies the password against the hash stored in the database. 
// If the verification succeeds, it generates a JSON Web Token (JWT) with a payload that 
// includes the user's name, email, and expiration time, and returns the token in a JSON 
// response along with a 200 status code. If the verification fails, it returns an error 
// message with a 401 status code.

// The `create()` method receives a name, email, and password, inserts a new user with 
// those values into the database, generates a JWT for the new user, and returns the token 
// in a JSON response along with a 200 status code. If the insertion fails, it returns an 
// error message with a 500 status code.

// The `verify()` method receives a JWT from an HTTP `Authorization` header, queries the 
// database for a user with a matching `remember_token`, and returns the user's name and 
// email in a JSON response along with a 200 status code if a match is found. If there is 
// no match, it returns an error message with a 401 status code.