<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/dbConnect.php';

    $sql ="SELECT * FROM registration WHERE id= {$_SESSION['user_id']}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>
<body>
    <h1>home page</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hello <?= htmlspecialchars( $user["firstname"] ) ?></p>
    <p><a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p><a href="login.php">Login</a> or <a href="signup.php"> sign up</a> </p>
    <?php endif; ?>

</body>
</html>