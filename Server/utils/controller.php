<?php
class Controller {
    protected $db;

    public function __construct() {
        // Connect to the database
        include 'db/dbConnect.php';
        $this->db = $mysqli;
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }
    /**
     * Get all rows from a table
     * @param string $table
     * @param string $sortedBy (name of the column to sort by)
     * @param string $filter (SQL WHERE clause)
     * @return array
     */
    public function getAll($table,$sortedBy = "firstname", $filter = "TRUE") {
        $query = "SELECT * FROM $table WHERE $filter ORDER by $sortedBy ASC";
        $result = $this->db->query($query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }
    /**
     * Get top X rows from a table
     * @param string $table
     * @param int $limit
     */
}