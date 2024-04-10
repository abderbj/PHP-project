<?php
abstract class Controller {
    protected $db;
    protected $table;
    protected $where;
    protected $orderBy;
    protected $having;

    public function __construct($table) {
        // Connect to the database
        include 'db/dbConnect.php';
        $this->db = $mysqli;
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
        $this->table = $table;
        $this->where = "TRUE";
        $this->orderBy = "firstname ASC";
    }
    /**
     * Get all rows from a table
     * @return array
     */
    abstract function getAll();

    public function setWhere($where) {
        $this->where = $where;
    }
    public function addWhere($where) {
        $this->where .= " AND $where";
    }

    public function setOrderBy($orderBy) {
        $this->orderBy = $orderBy + " ASC";
    }
    /**
     * Toggle the order of the orderBy clause (ASC to DESC or vice versa)
     * @return void
     */
    public function toggleOrderBy() {
        $aux = implode(" ",array_slice(explode(" ", $this->orderBy),0,-1));
        if ($this->orderBy[-3]=="A") {
            $this->orderBy = $aux." DESC";
        } else {
            $this->orderBy = $aux." ASC";
        }
    }

    public function setHaving($having) {
        $this->having = $having;
    }
    
}