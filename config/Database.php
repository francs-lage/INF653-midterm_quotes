<?php 
// The main part of this code comes from the PDO-intro Week 6 assignment
class Database{
    private $connection;
    private $host;
    private $database;
    private $username;
    private $password;
    
    function __construct(){
        $this->connection = null;
        $url     = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
        $this->$host     = $dbparts['host'];
        $this->$database  = ltrim($dbparts['path'], '/');
        $this->$username = $dbparts['user'];
        $this->$password = $dbparts['pass'];
    }
    public function connect(){
        try {
            $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $this->database, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error_message = 'Database Error: ';
            $error_message .= $e->getMessage();
            echo $error_message;
            exit('Unable to connect to the database');
        }
        return $this->connection;
    }
}