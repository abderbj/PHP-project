<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo(json_encode($_POST['firstName']));
    echo(json_encode($_POST['image']));
    $requiredFields = ['firstName', 'lastName', 'phoneNumber', 'email', 'password'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            echo("Required field '$field' is missing.");
        }
    }
    $image = $_POST['image'];
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = base64_decode($image);
    $imageName = uniqid() . '.png';
    $imagePath = 'images/' . $imageName;
    file_put_contents($imagePath, $image);
    // header('Access-Control-Allow-Origin: http://localhost:3000');

    require 'dbConnect.php';
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('message'=> 'Invalid email address'));
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    // $verificationCode = mt_rand(100000, 999999);

    $sql = "select * from users where email='$email' ";
    $result = $mysqli->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            echo json_encode(array("message"=>"User already exists"));
        } else {
            echo json_encode(array("message"=>"User created successfully"));
            echo json_encode(array("message"=>"User already exists2"));

            $sql = "INSERT INTO `users` (firstname, lastname, phonenumber, email, password,pfp_path) 
                    VALUES ('$firstname', '$lastname', '$phoneNumber', '$email', '$password_hash','$imagePath')";
            echo json_encode(array("message"=>"User already exists3"));

            $mysqli->query($sql);
            echo json_encode(array("message"=>"User already 5edmet"));

            $message = "Registration successful. Please login to continue.";
            // header("location:login.php?message=" . urlencode($message));

            exit();
        }
    }
}
