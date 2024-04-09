<?php
require_once 'controller.php';
class RideController extends Controller {
    
    public function __construct() {
        parent::__construct("rides");
    }
    /**
     * Get all rides
     * @uses String having (as in having at least X places available)
     * @return void
     */
    public function getAll() {
        //$query = "Select rides.*, users.*,(select count(*) from users where users.joined_id = rides.id) as number_users from rides, users where rides.id = users.driving_id 
        //";
        $query = "select * from rides";
        $result = $this->db->query($query);
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    /**
     * create a ride
     * @param string $driver
     * @param string $departure
     * @param string $arrival
     * @param string $date
     * @param string $price
     * @param string $places
     * @param string $description
     * @return void
     */
    public function createRide($driver, $departure, $arrival, $date,$time, $places, $price, $description) {
        // $driver = $_SESSION['user_id'];
        $query = "INSERT INTO rides (departure, arrival, departure_date, departure_time, price, places, description)
                  VALUES ('$departure', '$arrival', '$date','$time', '$price', '$places', '$description')";
        $result = $this->db->query($query);
        $ride_id = $this->db->insert_id;
        $query = "UPDATE users SET driving_id = $ride_id WHERE id = $driver";
        $result = $this->db->query($query);
        if($result) {
            echo json_encode(array("message"=>"Ride created successfully"));
            return;
        } else {
            echo json_encode(array("message"=>"Failed to create ride"));
            return;
        }
    }
    /**    
     * delete a ride
     * @param int $user_id
     */
    public function delete($user_id) {
        $query = "DELETE FROM rides WHERE id in (SELECT driving_id FROM users WHERE id = $user_id)";
        $result = $this->db->query($query);
        if($result) {
            echo json_encode(array("message"=>"Ride deleted successfully"));
            return;
        } else {
            echo json_encode(array("message"=>"Failed to delete ride"));
            return;
        }
    }
}