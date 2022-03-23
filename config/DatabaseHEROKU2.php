<?php

class Database {

    private $connection;
    private $url;
    private $hostname;
    private $username;
    private $password;
    private $database;

    function __construct() {
        $this->url = getenv('JAWSDB_URL');
        $dbparts   = parse_url($this->$url);
        $this->hostname = $dbparts['host'];
        $this->username = $dbparts['user'];
        $this->password = $dbparts['pass'];
        $this->database = ltrim($dbparts['path'], '/');
    }

    public function connect(){
        $this->connection = null;
        try{
            $this->connection = new PDO('mysql:host='. $this->hostname . ';dbname='. $this->database, $this->username, $this->password);
            // set the PDO mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully
        }catch(PDOException $e){
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->connection;
    }
}