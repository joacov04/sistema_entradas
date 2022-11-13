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

    // This shouldn't be calling a python script
    public function createQr($person_name, $seller) {
        $name = str_replace(' ', '_', $person_name);
        $ret = system('python3  app/creador.py '.$name.' '.$seller.' '.$this->party_name);
        return $ret;
    } 

    public function getAllTickets() {
        $sql = $this->conn->query("SELECT * FROM ".$this->party_name);
        while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
            $nombre = $row['nombre'];
            $token = $row['token'];
            $vendedor = $row['vendedor'];
            $usada = $row['usada'];

            echo $nombre;
            echo $token;
            echo $usada;
            echo $vendedor;
            echo PHP_EOL;
        }

    }

}
$fdp = new Fiesta("vol2", "fdp", "fiestadelpolitecnico", "entradas", "localhost");
$fdp->createQr("probando_1", "joaquin");
$fdp->getAllTickets();
?>
