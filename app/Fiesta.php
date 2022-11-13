<?php

class Fiesta {
    private $party_name;
    private $conn;
    public function __construct($name, $dbuser, $dbpass, $dbname, $dbhost) {

        $this->conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
          die("Connection failed: " . $this->conn->connect_error);
        }
        $party = str_replace(' ', '_', $name);
        $this->party_name = mysqli_real_escape_string($this->conn, $party);

        $this->conn->query("CREATE TABLE IF NOT EXISTS ".$this->party_name." (
            token text,
            nombre text,
            usada boolean,
            vendedor text);");

    }

    public function connect($name) : bool {
        //esto esta mal use es para db no tbales
        $party_name = str_replace(' ', '_', $name);
        $statement = $this->conn->prepare("use ?");
        $statement->bind_param('s', $party_name);
        return $statement->execute();
    }

    /**
     * Creates a QR ticket for $person_name
     *
     * Generates an image with the QR Ticket under qr/ directory,
     * saves the name of owner and seller in the database and generates
     * a random string token associated to the ticket, used value is set to 0
     *
     * @param string $person_name The name of the Ticket owner
     *
     * @param string $seller The system name whom sold the Ticket
     *
     */
    public function createQr($person_name, $seller) {

        // This shouldn't be calling a python script
        $name = str_replace(' ', '_', $person_name);
        $ret = system('python3  app/creador.py '.$name.' '.$seller.' '.$this->party_name);
        return $ret;
    } 

    public function getAllTickets() {
        $sql = $this->conn->query("SELECT * FROM ".$this->party_name);
        while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
            echo json_encode($row);
            echo PHP_EOL;
        }
    }

    public function searchToken($token) {
        $secure_token = mysqli_real_escape_string($this->conn, $token);
        $sql = $this->conn->query("SELECT * FROM ".$this->party_name." WHERE token='".$secure_token."' ");

        $row_cnt = $sql->num_rows;
        if ($row_cnt > 0) {
            $row = $sql->fetch_array(MYSQLI_ASSOC);
            echo json_encode($row);
        } else {
            echo json_encode(2);
        }
    }

    public function setAsUsed($token) {
        $secure_token = mysqli_real_escape_string($this->conn, $token);
        $sql = $this->conn->query("UPDATE ".$this->party_name." SET usada=1 WHERE token='".$secure_token."' ");
        if (!$sql) throw new \Exception("sql error: ".$this->conn->error);
        return $this->conn->info;
    }

    public function deleteToken($token) {
        $secure_token = mysqli_real_escape_string($this->conn, $token);
        $sql = $this->conn->query("DELETE FROM ".$this->party_name." WHERE token='".$secure_token."' ");
        if (!$sql) throw new \Exception("sql error: ".$this->conn->error);
        return $sql;
    }

    public function toggleUsedStatus($token) {

    }

}
$fdp = new Fiesta("vol2", "fdp", "fiestadelpolitecnico", "entradas", "localhost");
$fdp->createQr("nueva_entrada", "joaquin");
$fdp->getAllTickets();
echo $fdp->setAsUsed("HNPBCJWOPEAAYPO");
echo $fdp->deleteToken("FCSDNFZHEJIJRIF");
?>
