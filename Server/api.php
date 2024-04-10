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
// else if($action === "logout"){
//     session_destroy();
//     echo json_encode(array("message"=>"logged out successfully"));
// }
else if($action === "getAllUsers"){
    //OPTIONAL ARGS
    if(isset($_POST['orderBy'])){
        $userController->setOrderBy($_POST['orderBy']);
    }
    if(isset($_POST['rating'])){
        $userController->setWhere("rating >= " . $_POST['rating']);
    }
    if(isset($_POST['firstName'])){
        $userController->addWhere("firstname LIKE '%".$_POST['firstName']."%'");
    }
    if(isset($_POST['lastName'])){
        $userController->addWhere("lastname LIKE '%".$_POST['lastName']."%'");
    }
    echo json_encode($userController->getAll());
}
else if($action === "report"){
    $userController->report($_POST['id'],$_POST['reported_id']);
}
else if($action === "deleteUser"){
    $userController->delete($_POST['id']);
}
else if($action === "rate"){
    $userController->rate($_POST["rated_id"], $_POST["rating"]);
}
else if($action === "joinRide"){
    $userController->joinRide($_POST["id"],$_POST["ride_id"]);

}
else if($action === "count"){
    echo json_encode(array("total"=>$userController->count()));
}
/**
 * @todo Add ride actions
 */
else if($action === "getAllRides"){
    if(isset($_POST['orderBy'])){
        $rideController->setOrderBy($_POST['orderBy']);
    }
    if(isset($_POST['departure'])){
        $rideController->addWhere("departure LIKE '%".$_POST['departure']."%'");
    }
    if(isset($_POST['arrival'])){
        $rideController->addWhere("arrival LIKE '%".$_POST['arrival']."%'");
    }
    //Date Format yyyy-mm-dd
    if(isset($_POST['date'])){
        $rideController->addWhere("date = '".$_POST['date']."'");
    }
    if(isset($_POST['price'])){
        $rideController->addWhere("price <= ".$_POST['price']);
    }
    if(isset($_POST['rating'])){
        $rideController->addWhere("rating >= ".$_POST['rating']);
    }
    // if(isset($_POST['where'])){
    //     $rideController->setWhere($_POST['where']);
    // }
    /**
     * @example $_POST['having'] = 2 (as in having at least 2 places available)
     */
    if(isset($_POST['having'])){
        $rideController->setHaving($_POST['having']);
    } 
    echo json_encode($rideController->getAll());
}
else if($action === "createRide"){
    $rideController->createRide($_POST["id"],$_POST['departure'], $_POST['arrival'], $_POST['date'], $_POST['time'], $_POST['seats'], $_POST['price'], $_POST['description']);
}
else if($action === "deleteRide"){
    $rideController->delete($_POST['id']);
}
else if($action === "cancelJoin"){
    $userController->cancelJoin($_POST["id"],$_POST["ride_id"]);
}
else {
    echo json_encode(array("message"=>"Invalid action"));
}



