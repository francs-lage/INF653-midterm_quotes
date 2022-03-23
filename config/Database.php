<?php 
// The main part of this code comes from the PDO-intro Week 6 assignment
class Database{
    private $connection;
    private $host;
    private $db_name;
    private $username;
    private $password;
    
    function __construct(){
        $url     = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
        $this->$host     = $dbparts['host'];
        $this->$db_name  = ltrim($dbparts['path'], '/');
        $this->$username = $dbparts['user'];
        $this->$password = $dbparts['pass'];
    }
    public function connect(){
        try {
            $this->connection = new PDO("mysql:host={$this->$host};dbname={$this->$db_name}", $this->$username, $this->$password);
            $this->connection = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error_message = 'Database Error: ';
            $error_message .= $e->getMessage();
            echo $error_message;
            exit('Unable to connect to the database');
        }
    }
}