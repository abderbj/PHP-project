<?php

include 'request.php';
echo json_encode(array("message"=>"User created hello"));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo($_POST['firstName']);
    $requiredFields = ['firstName', 'lastName', 'phoneNumber', 'email', 'password'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            echo("Required field '$field' is missing.");
        }
    }

    require 'dbConnect.php';
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // echo($email);
    // echo($password);
    // echo($firstname);
    // echo($lastname);
    // echo($phoneNumber);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $verificationCode = mt_rand(100000, 999999);

    $sql = "select * from registration where email='$email' ";
    $result = $mysqli->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            // echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            //         Email already exists.
            //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //     </div>';
            echo json_encode(array("message"=>"Email already exists. Please login to continue."));
        } else {
            echo json_encode(array("message"=>"User created successfully"));
            $sql = "INSERT INTO `registration` (firstname, lastname, phonenumber, email, password, activation_code) 
                    VALUES ('$firstname', '$lastname', '$phoneNumber', '$email', '$password_hash', '$verificationCode')";

            $mysqli->query($sql);
            $message = "Registration successful. Please login to continue.";
            // header("location:login.php?message=" . urlencode($message));

            exit();
        }
    }
}
