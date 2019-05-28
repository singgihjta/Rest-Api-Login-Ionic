<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');
require 'config.php';

require 'vendor/autoload.php';

$app = new Slim\App();

$app->post('/login','login');
$app->run();

function login($request, $response) {
   $data = $request->getParsedBody();
    try {        
        $db = getDB();
        $userData ='';
        $sql = "SELECT username, nama, email FROM users WHERE username=:username and password=:password";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $data['username'], PDO::PARAM_STR);
        $stmt->bindParam("password", $data['password'], PDO::PARAM_STR);
        $stmt->execute();
        $mainCount=$stmt->rowCount();
        $userData = $stmt->fetch(PDO::FETCH_OBJ);        
        if(!empty($userData))
        {
            $username=$userData->username;
            $userData->token = apiToken($username);
         }        
        $db = null;
         if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            } else {
               echo '{"error":{"text":"Bad request wrong username and password"}}';
            }           
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }    
}
