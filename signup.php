<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'dbConnect.php';
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $verificationCode = mt_rand(100000, 999999);

    $sql = "select * from registration where email='$email' ";
    $result = $mysqli->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email already exists.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } else {
            $sql = "INSERT INTO `registration` (firstname, lastname, phonenumber, email, password, activation_code) 
                    VALUES ('$firstname', '$lastname', '$phoneNumber', '$email', '$password_hash', '$verificationCode')";

            $mysqli->query($sql);
            $message = "Registration successful. Please login to continue.";
            header("location:login.php?message=" . urlencode($message));
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>sign up </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <form action="signup.php" method="post">
        <input name="firstName" type="text" required />
        <input name="lastName" type="text" required />
        <input name="phoneNumber" type="number" />
        <input name="email" type="text" required />
        <input name="password" type="password" required />
        <input name="register" type="submit" value="Register" />
    </form>
    <script>
        var alertCloseButtons = document.querySelectorAll('.btn-close');
        alertCloseButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                let alert = button.closest('.alert');
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.remove();
                }, 300);
            });
        });
    </script>
</body>

</html>