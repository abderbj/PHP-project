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
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }
    /**
     * Get ride by departure, arrival and date
     * @param string $departure
     * @param string $arrival
     * @param string $date
     * @return array
     */
    
}