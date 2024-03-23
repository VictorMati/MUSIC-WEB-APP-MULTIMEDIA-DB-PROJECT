<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "@Vmn_6887!7886";
    private $dbname = "multimedia_db_group"; 
    private $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function close() {
        $this->conn->close();
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function escapeString($str) {
        return $this->conn->real_escape_string($str);
    }
}
?>
