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
        $query = "SELECT u.*, r.*, COUNT(joined_user.id) AS num_users_joining
                  FROM users u
                  JOIN rides r ON u.driving_id = r.id
                  LEFT JOIN users joined_user ON r.id = joined_user.joined_id
                  GROUP BY u.id, r.id;
                  WHERE $this->where
                  GROUP BY r.id
                  HAVING (r.places - num_users_joined) >= $this->having
                  ORDER by $this->orderBy";
        $result = $this->db->query($query);
        if($result->num_rows == 0) {
            echo json_encode(array("message"=>"No rides found"));
            return;
        }
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
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
        $query = "INSERT INTO rides (departure, arrival, date,time, price, places, description)
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