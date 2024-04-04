<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $mysqli= require __DIR__.'/dbConnect.php';

        $sql = sprintf("SELECT * FROM users WHERE email='%s'",
        $mysqli->real_escape_string($_POST['email']));
        
        $result = $mysqli->query($sql);    
        $user = $result->fetch_assoc();
 
    if ($user) {
        $isAdmin = $user['is_admin'] == 1 ? true : false;

    echo json_encode(array(
        "user" => $user,
        "isAdmin" => $isAdmin,
        "post" => $_POST
    ));
        if (password_verify($_POST['password'], $user['password'])) {
            
            session_start();
            
            session_regenerate_id();

            $_SESSION['user_id'] = $user['id'];
            exit;
        }
        else{
            echo json_encode(array("message"=>"Invalid email or password"));
            http_response_code(401);
            exit;
        }
    }
}
 
?>