<?php
$is_invalid = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $mysqli= require __DIR__.'/dbConnect.php';

        $sql = sprintf("SELECT * FROM registration WHERE email='%s'",
        $mysqli->real_escape_string($_POST['email']));
        
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
 
    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
            exit;
            
        }
    }
    $is_invalid = true;
}
 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if ($is_invalid): ?>
        <em class="alert alert-danger" role="alert">
            Invalid email or password
    </em>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email"  name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit"  name="register" value="Register">
    </form>
</body>
</html>