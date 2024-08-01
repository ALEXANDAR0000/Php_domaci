<?php 
class Zaposleni {
    private $conn;
    private $table_name = "zaposleni";

    public $id;
    public $user_name;
    public $password;
    public $zanimanje;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function sviZaposleni() {
        $query = "SELECT id, user_name, zanimanje FROM " . $this->table_name;
        $result = $this->conn->query($query);

        return $result;
    }

    public function dodajZaposlenog() {
        $query = "INSERT INTO " . $this->table_name . " (user_name, password, zanimanje) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sss", $this->user_name, $this->password, $this->zanimanje);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>