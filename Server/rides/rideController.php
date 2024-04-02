<?php
require_once 'utils/controller.php';
class RideController extends Controller {
    public function __construct() {
        parent::__construct("rides");
    }
    /**
     * Get all rides
     * @param string $sortedBy (name of the column to sort by)
     * @param string $where (SQL WHERE clause)
     * @return array
     */
    public function getAll($sortedBy = "departure_date", $where = "TRUE", $having = 1) {
        $query = "SELECT u.firstname AS driver_firstname, u.lastname AS driver_lastname, u.pfp_path AS driver_pfp_path, u.id AS driver_id, u.phonenumber AS driver_phonenumber, u.rating AS driver_rating, r.departure, r.arrival, r.departure_time, r.departure_date, r.places, r.description, COUNT(j.joined_id) AS num_users_joined
                  FROM rides r
                  INNER JOIN  users u ON r.driver = u.id
                  LEFT JOIN users j ON r.id = j.joined_id
                  WHERE $where 
                  GROUP BY r.id
                  HAVING (r.places - num_users_joined) >= $having
                  ORDER by $sortedBy ASC";
        $result = $this->db->query($query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }
    /**
     * Get all rides
     * @param string $sortedBy (name of the column to sort by)
     * @param string $where (SQL WHERE clause)
     * @return array
     */
    public function getRides($sortedBy = "departure_time", $where = "TRUE") {
        $query = "SELECT * FROM $this->table WHERE $where ORDER by $sortedBy ASC";
        $result = $this->db->query($query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }
    /**
     * Get all rides
     * @param string $sortedBy (name of the column to sort by)
     * @param string $where (SQL WHERE clause)
     * @return array
     */
    public function getRidesByDriver($driver_id, $sortedBy = "departure_time", $where = "TRUE") {
        $query = "SELECT * FROM $this->table WHERE driver_id = $driver_id AND $where ORDER by $sortedBy ASC";
        $result = $this->db->query($query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }
    /**
     * Get all rides
     * @param string $sortedBy (name of the column to sort by)
     * @param string $where (SQL WHERE clause)
     * @return array
     */
    public function getRidesByPassenger($passenger_id, $sortedBy = "departure_time", $where = "TRUE") {
        $query = "SELECT * FROM $this->table WHERE passenger_id = $passenger_id AND $where ORDER by $sortedBy ASC";
        $result = $this->db->query($query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }
    /**
     * Get all rides
     * @param string $sortedBy (name of the column to sort by)
     * @param string $where (SQL WHERE clause)
     * @return array
     */
}