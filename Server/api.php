<?php
include "controllers/header.php";
include "controllers/userController.php";
include "controllers/rideController.php";

$userController = new UserController();
$rideController = new RideController();

if (isset($_POST['action'])) {

    $action = $_POST['action'];
}
else {
    echo json_encode(array("message"=>"No action specified"));
    exit();
}

if($action === "signUp"){
    $_POST['image'] = $_POST['image'] ?? null;
    $userController->signUp($_POST['firstName'], $_POST['lastName'], $_POST['phoneNumber'], $_POST['email'], $_POST['password'], $_POST['image']);
}
else if($action === "login"){
    $userController->login($_POST['email'], $_POST['password']);
}
else if($action === "getAllRides"){
    if(isset($_POST['orderBy'])){
        $rideController->setOrderBy($_POST['orderBy']);
    }
    if(isset($_POST['where'])){
        $rideController->setWhere($_POST['where']);
    }
    if(isset($_POST['having'])){
        $rideController->setHaving($_POST['having']);
    }
    echo json_encode($rideController->getAll());
}
else if($action === "getRide"){
    echo json_encode($rideController->getRide($_POST['departure'], $_POST['arrival'], $_POST['date']));
}
else if($action === "getRideById"){
    echo




