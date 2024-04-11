<?php
require_once 'controller.php';
class RideController extends Controller {
    
    public function __construct() {
        parent::__construct("rides");
    }
    /**
     * Get all rides
     * @uses String having (as in having at least X places available)
     * @return array
     */
    public function getAll() {
        $query = "SELECT 
        rides.*, 
        drivers.firstname AS firstname,
        drivers.lastname AS lastname,
        drivers.email AS email,
        drivers.id AS driver_id,
        drivers.phonenumber AS phonenumber,
        drivers.pfp_path AS pfp_path,
        drivers.rating AS rating,
        COUNT(passengers.id) AS user_count
    FROM 
        rides 
    LEFT JOIN 
        users AS passengers ON rides.id = passengers.joined_id
    LEFT JOIN
        users AS drivers ON rides.id = drivers.driving_id
    WHERE 
        rides.places > 0 and $this->where
    GROUP BY 
        rides.id
    HAVING user_count < places-$this->having";
        $result = $this->db->query($query);
        $rows = array();
        while($row = $result->fetch_assoc()) {
            if (isset($row['pfp_path']) && file_exists($row['pfp_path'])) {
                $imageData = base64_encode(file_get_contents($row['pfp_path']));
                $row['pfp_path'] =$imageData;
            }
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
    public function createRide($driver, $departure, $arrival, $date, $time, $places, $price, $description) {
        $this->db->begin_transaction();
        $query = "SELECT driving_id FROM users WHERE id = $driver";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        if ($row['driving_id'] != null) {
            echo json_encode(array("user_already_driving" => TRUE));
            return;
        }
        $query = "INSERT INTO rides (departure, arrival, departure_date, departure_time, price, places, description)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssss", $departure, $arrival, $date, $time, $price, $places, $description);
    
        if ($stmt->execute()) {
            $ride_id = $this->db->insert_id;
            $stmt->close();
    
            $query = "UPDATE users SET driving_id = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $ride_id, $driver);
            echo(json_encode(array("ttt" => "Ride created successfully", "ride_id" => $driver)));
            if ($stmt->execute()) {
                $this->db->commit();
                echo json_encode(array("message" => "Ride created successfully", "ride_id" => $ride_id));
            } else {
                $this->db->rollback();
                echo json_encode(array("message" => "Failed to update driver information"));
            }
        } else {
            $this->db->rollback();
            echo json_encode(array("message" => "Failed to create ride"));
        }
    
        $stmt->close();
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