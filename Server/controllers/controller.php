<?php
abstract class Controller {
    protected $db;
    protected $table;
    protected $where;
    protected $orderBy;
    protected $having;

    public function __construct($table) {
        // Connect to the database
        include 'dbConnect.php';
        $this->db = $mysqli;
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
        $this->table = $table;
        $this->where = "TRUE";
        $this->having = "TRUE";
        $this->orderBy = "firstname ASC";
    }
    /**
     * Get all rows from a table
     * @return void
     */
    abstract function getAll();

    public function setWhere($where) {
        $this->where = $where;
    }
    public function addWhere($where) {
        $this->where .= " AND $where";
    }
    /**
     * Set the orderBy clause
     * @param string $orderBy (MUST HAVE ASC OR DESC AT THE END)
     */
    public function setOrderBy($orderBy) {
        $this->orderBy = $orderBy;
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