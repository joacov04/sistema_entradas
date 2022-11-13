<?php

class Boliche {

    private $conn;
    public function __construct($dbuser, $dbpass, $dbname, $dbhost) {

        $this->conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
          die("Connection failed: " . $this->conn->connect_error);
        }

    }

    public function getAllParties() {
        $sql = $this->conn->query("SHOW TABLES;");
        return $sql->fetch_all(MYSQLI_NUM);
    }

}

$bios = new Boliche("fdp", "fiestadelpolitecnico", "entradas", "localhost");

?>
