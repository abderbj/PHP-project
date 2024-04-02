<?php

include 'utils/controller.php';
include 'user.php';
class UserController extends Controller {

    public function __construct() {
        parent::__construct("users");
    }
    /**
     * Get all $this->table
     * @param string $name
     * @param string $sorted (name of the column to sort by)
     * @param string $where (SQL WHERE clause)
     * @return array
     * 
     */
    public function findByName($name, $sorted = "firstname", $where="TRUE") {
        $query = "SELECT * FROM $this->table WHERE (first_name LIKE '%$name%' OR last_name LIKE '%$name%')AND $where ORDER BY $sorted ASC";
        $result = $this->db->query($query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }
    /**
     * Get register user in db
     * @param string $firstName
     * @param string $lastName
     * @param string $phoneNumber
     * @param string $email
     * @param string $password
     * @param string $pfpPath
     * @return boolean
     */
    public function signup($firstName, $lastName, $phoneNumber, $email, $password, $pfpPath="Server/db/im/default.jpg") {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $verificationCode = mt_rand(100000, 999999);

        $sql = "select id from registration where email='$email' ";
        $result = $this->db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                echo json_encode ('khatar this user already exists');
                return false;
            } else {
                echo json_encode(array("message"=>"User created successfully"));
                $sql = "INSERT INTO `registration` (firstname, lastname, phonenumber, email, password, pfp_path, activation_code) 
                        VALUES ('$firstName', '$lastName', '$phoneNumber', '$email', '$password_hash', '$verificationCode')";

                $this->db->query($sql);
                $message = "Registration successful. Please login to continue.";
                header("location:login.php?message=" . urlencode($message));

                return true;
            }
        }
        else {
            echo("Failed to create user");
            return false;
        }
    }
    /**
     * Login user
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function login($email, $password) {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }else{
            echo json_encode("You are already logged in, please logout first");
            return false;
        }
        $sql = "select password, is_admin from registration where email='$email' ";
        $result = $this->db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {

                    echo json_encode(array("message"=>"Login successful",
                                           "is_admin"=>$row['is_admin']));
                    $_SESSION['user_id'] = $row['id'];
                    return true;
                } else {
                    echo json_encode(array("message"=>"Incorrect password"));
                    return false;
                }
            } else {
                echo json_encode(array("message"=>"User not found"));
                return false;
            }
        } else {
            echo json_encode(array("message"=>"Failed to login"));
            return false;
        }
    }
    /**
     * Logout user
     * @return void
     */
    public function logout() {
        session_start();
        session_destroy();
        header("location:login.php");
    }
    /**
     * Get number of $this->table
     * @return int
     */
    public function count() {
        $query = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    /**
     * delete user
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id=$id";
        $result = $this->db->query($sql);
        if ($result) {
            echo json_encode(array("message"=>"User deleted successfully"));
            return true;
        } else {
            echo json_encode(array("message"=>"Failed to delete user"));
            return false;
        }
    }
    /**
     * Report user
     * @param int $id
     * @return void
     */
    public function report($id) {
        $sql = "SELECT * FROM $this->table WHERE id=$id ORDER BY firstname ASC";
        $reporter_id = $_SESSION['user_id'];
        $result = $this->db->query($sql);
        if ($result["rating"] <= 1 and $result["nb_ratings"] > 2) {
            $name = $result["firstname"] . " " . $result["lastname"];
            $sender = $this->db->query("SELECT email FROM $this->table WHERE id=$reporter_id")["email"];
            $to = $this->db->query("SELECT email FROM $this->table WHERE is_admin=1")["email"];
            $subject = "User Report";
            $message = "User $name with ID $id has been reported. Please take appropriate action.";
            $headers = "From: $sender" . "\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            if (mail($to, $subject, $message, $headers)) {
                echo json_encode(array("message" => "Report sent successfully"));
            } else {
                echo json_encode(array("message" => "Failed to send report"));
            }
        }
    }
    /**
     * Get user table with number of joined and created rides
     * @param string $sortedBy (name of the column to sort by)
     * @param string $where (SQL WHERE clause)
     * @param string $having (SQL HAVING clause)
     * @return array
     */
    public function getAll($sortedBy = "firstname", $where = "TRUE", $having = "TRUE") {
        $query = "SELECT u.id, u.firstname, u.lastname, u.phonenumber, u.email, u.rating, u.pfp_path, COUNT(DISTINCT cr.id) AS created_rides, COUNT(DISTINCT jr.id) AS joined_rides
                  FROM $this->table u
                  LEFT JOIN rides cr ON u.id = cr.driver
                  LEFT JOIN rides jr ON u.id = jr.joined_id
                  WHERE $where
                  GROUP BY u.id, u.firstname, u.lastname, u.phonenumber, u.email, u.rating, u.pfp_path;
                  HAVING $having
                  ORDER BY $sortedBy ASC";
        $result = $this->db->query($query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }
    /**
     * Rate user
     * @param int $id
     * @param int $rating
     * @return boolean
     */
    public function rate($id,$rating){
        if(session_status() == PHP_SESSION_NONE){
            echo json_encode(array("message"=> "You are not logged in, please login first"));
            return false;
        }
        $sql = "SELECT rating, nb_ratings FROM $this->table WHERE id=$id";
        $result = $this->db->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $new_rating = ($row['rating'] * $row['nb_ratings'] + $rating) / ($row['nb_ratings'] + 1);
            $sql = "UPDATE $this->table SET rating=$new_rating, nb_ratings=nb_ratings+1 WHERE id=$id";
            $result = $this->db->query($sql);
            if ($result) {
                echo json_encode(array("message"=>"User rated successfully"));
                return true;
            } else {
                echo json_encode(array("message"=>"Failed to rate user"));
                return false;
            }
        } else {
            echo json_encode(array("message"=>"User not found"));
            return false;
        }
    }
    /**
     * join ride
     * @param int $ride_id
     * @return boolean
     */
    public function joinRide($ride_id){
        if(session_status() == PHP_SESSION_NONE){
            echo json_encode(array("message"=> "You are not logged in, please login first"));
            return false;
        }
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO joined_rides (user_id, ride_id) VALUES ($user_id, $ride_id)";
        $result = $this->db->query($sql);
        if ($result) {
            echo json_encode(array("message"=>"Ride joined successfully"));
            return true;
        } else {
            echo json_encode(array("message"=>"Failed to join ride"));
            return false;
        }
    }
}   