<?php
abstract class Controller {
    protected $db;
    protected $table;

    public function __construct($table) {
        // Connect to the database
        include 'db/dbConnect.php';
        $this->db = $mysqli;
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
        $this->table = $table;
    }
    /**
     * Get all rows from a table
     * @param string $sortedBy (name of the column to sort by)
     * @param string $where (SQL WHERE clause)
     * @param string $having (SQL HAVING clause)
     * @return array
     */
    abstract function getAll($sortedBy, $where, $having);

    
}