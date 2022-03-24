<?php 
// The main part of this code comes from the PDO-intro Week 6 assignment
class Database{
    private $conn;
    private $url;
    private $host;
    private $database;
    private $username;
    private $password;
    
    function __construct(){
        $this->conn = null;
        $this->$url       = getenv('JAWSDB_URL');
        $dbparts = parse_url($this->url);
        $this->$host     = $dbparts['host'];
        $this->$database  = ltrim($dbparts['path'], '/');
        $this->$username = $dbparts['user'];
        $this->$password = $dbparts['pass'];
    }
    public function connect(){

        // $dbparts = parse_url($this->url);
        // $host     = $dbparts['host'];
        // $dbname   = ltrim($dbparts['path'], '/');
        // $username = $dbparts['user'];
        // $password = $dbparts['pass'];
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error_message = 'Database Error: ';
            $error_message .= $e->getMessage();
            echo $error_message;
            exit(' -- Unable to connect to the database.');
        }
        return $this->conn;
    }
}