<?php
class Database {
    
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname;
    private $dblink;
    private $result;
    private $records;
    private $affected;
    
    function __construct($par_dbname) {
        $this->dbname = $par_dbname;
        $this->Connect();
    }
    
    function Connect() {
        $this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if($this->dblink->connect_errno) {
            printf("Konekcija neuspešna: %s\n", $this->dblink->connect_errno);
            exit();
        }
        $this->dblink->set_charset("utf8");
    }

    function executeQuery($query) {
        $this->result = $this->dblink->query($query);
        if ($this->result) {
            if(isset($this->result->num_rows)) {
                $this->records = $this->result->num_rows;
            }
            if(isset($this->result->affected_rows)) {
                $this->affected = $this->result->affected_rows;
            }
            return true;
        } else {
            return false;
        }
    }

    function getResult() {
        return $this->result;
    }

    function select($table="ocene-filmova") {
        
    }

    function insert() {

    }

    function update() {

    }

    function delete() {

    }


}
?>