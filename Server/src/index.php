<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/dbConnect.php';

    $sql ="SELECT * FROM registration WHERE id= {$_SESSION['user_id']}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>
