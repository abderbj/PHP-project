<?php

include 'controller.php';
class UserController extends Controller {

    public function __construct() {
        parent::__construct("users");
    }
    /**
     * Get register user in db
     * @param string $firstName
     * @param string $lastName
     * @param string $phoneNumber
     * @param string $email
     * @param string $password
     * @param string $pfp
     * @return void
     */
    public function signup($firstName, $lastName, $phoneNumber, $email, $password, $image) {
        if($image != null){
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = base64_decode($image);
            $imageName = uniqid() . '.PNG';
            $imagePath = 'images/' . $imageName;
            file_put_contents($imagePath, $image);
        }
        else{
            $imagePath = 'images/default.PNG';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array('message'=> 'Invalid email address'));
            return;
        }
        
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        // $verificationCode = mt_rand(100000, 999999);
        
        $sql = "select * from users where email='$email' ";
        $result = $this->db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                echo json_encode(array("message"=>"User already exists"));
            } else {
                echo json_encode(array("message"=>"User created successfully"));
                echo json_encode(array("message"=>"User already exists2"));
                
                $sql = "INSERT INTO `users` (firstname, lastname, phonenumber, email, password,pfp_path) 
                        VALUES ('$firstName', '$lastName', '$phoneNumber', '$email', '$password_hash','$imagePath')";
                echo json_encode(array("message"=>"User already exists3"));
                
                $this->db->query($sql);
                echo json_encode(array("message"=>"User already 5edmet"));
                
                // header("location:login.php?message=" . urlencode($message));
            }
        }
    }
    /**
     * Login user
     * @param string $email
     * @param string $password
     * @return int $id
     */
    public function login($email, $password) {
        // if(session_status() == PHP_SESSION_NONE) {
        //     session_start();
        // }else{
        //     echo json_encode("You are already logged in, please logout first");
        //     return false;
        // }
        $sql = "select * from users where email='$email' ";
        $result = $this->db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    
                    echo json_encode(array("message"=>"Login successful",
                    "id" => $row['id'],
                    "email" => $row['email'],
                    "is_admin"=>$row['is_admin'],
                    "firstName"=>$row['firstname'],
                    "lastName"=>$row['lastname'],
                    "pfp"=> base64_encode(file_get_contents($row['pfp_path']))));
                    // $_SESSION['user_id'] = $row['id'];
                    return $row['id'];
                } else {
                    echo json_encode(array("message"=>"Incorrect password"));
                    return -1;
                }
            } else {
                echo json_encode(array("message"=>"User not found"));
                return -1;
            }
        } else {
            echo json_encode(array("message"=>"Failed to login"));
            return -1;
        }
    }
    /**
     * Logout user
     * @return void
     */
    // public function logout() {
    //     session_start();
    //     session_destroy();
    //     // header("location:login.php");
    // }
    /**
     * Get number of $this->table
     * @return int
     */
    public function count() {
        $query = "SELECT COUNT(*) as total FROM users";
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
        $sql = "DELETE FROM rides
        WHERE id = (
        SELECT driving_id
        FROM users
        WHERE id = $id);
        DELETE FROM users
        WHERE id = $id";
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
     * @param int $reporter_id
     * @param int $id
     * @return void
     */
    public function report($reporter_id, $id) {
        $sql = "SELECT * FROM users WHERE id=$id ORDER BY firstname ASC";
        // $reporter_id = $_SESSION['user_id'];
        $result = $this->db->query($sql);
        if ($result["rating"] <= 1 and $result["nb_ratings"] > 2) {
            $name = $result["firstname"] . " " . $result["lastname"];
            $sender = $this->db->query("SELECT email FROM users WHERE id=$reporter_id")["email"];
            $to = $this->db->query("SELECT email FROM users WHERE is_admin=1")["email"];
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
     * @param string $this->where (SQL WHERE clause)
     * @param string $this->having (SQL HAVING clause)
     * @return array
     */
    public function getAll() {
        $query = "select * from users";
        $result = $this->db->query($query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $pfp = base64_encode(file_get_contents($row['pfp_path']));
            $row['pfp'] = $pfp;
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
        // if(session_status() == PHP_SESSION_NONE){
        //     echo json_encode(array("message"=> "You are not logged in, please login first"));
        //     return false;
        // }
        $sql = "SELECT rating, nb_ratings FROM users WHERE id=$id";
        $result = $this->db->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $new_rating = ($row['rating'] * $row['nb_ratings'] + $rating) / ($row['nb_ratings'] + 1);
            $sql = "UPDATE users SET rating=$new_rating, nb_ratings=nb_ratings+1 WHERE id=$id";
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
     * @param int $user_id
     * @param int $ride_id
     * @return boolean
     */
    public function joinRide($user_id, $ride_id){
        // if(session_status() == PHP_SESSION_NONE){
        //     echo json_encode(array("message"=> "You are not logged in, please login first"));
        //     return false;
        // }
        // $user_id = $_SESSION['user_id'];
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
    /**
     * Get user profile picture
     * @param string $path
     * @return string
     */
    public function getPfp($path){
        $pfp = file_get_contents($path);
        return base64_encode($pfp);
    }
    /**
     * Get all $this->table
     * @param string $name
     * @param string $this->where (SQL WHERE clause)
     * @return array
     * 
     */
    public function findByName($name) {
        $this->where = "firstname LIKE '%$name%' OR lastname LIKE '%$name%'";
        return $this->getAll();
    }
}   