<?php
class Author{
    // Database 
    private $connection;
    private $table = 'authors';

    // Properties
    public $id;
    public $author;

    // Constructor with DB
    public function __construct($db){
        $this->connection = $db;
    }

    // Get all authors
    public function read(){
        //create query
        $query =   'SELECT authors.id, authors.author
                    FROM ' . $this->table . '
                    ORDER BY authors.id';
        
        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Execute query
        $statement->execute();
        return $statement;
    }

    // Get single author
    public function read_single(){
        //create query
        $query =   'SELECT authors.id, authors.author
                    FROM ' . $this->table . '
                    WHERE authors.id = ?
                    LIMIT 0,1';
        
        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Bind id
        $statement->bindParam(1, $this->id);
        // Execute query
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        // Set properties
        $this->id       = $row['id'];
        $this->author   = $row['author'];
    }

    // Create Author 
    public function create(){
        // Create query
        $query =   'INSERT INTO ' . $this->table . '
                    SET author = :author';

        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));
        // Bind data 
        $statement->bindParam(':author', $this->author); 
        // Execute query
        if($statement->execute()){
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $statement->error);
        return false;
    }

    // Update Author
    public function update(){
        // Create query
        $query =   'UPDATE ' . $this->table . '
                    SET    author  = :author
                    WHERE  id = :id';

        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Clean data
        $this->id      = htmlspecialchars(strip_tags($this->id));
        $this->author  = htmlspecialchars(strip_tags($this->author));      
        // Bind data  
        $statement->bindParam(':id',     $this->id);
        $statement->bindParam(':author', $this->author);
        // Execute query
        if($statement->execute()){
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $statement->error);
        return false;
    }

    // Delete Author 
    public function delete(){
        // create query
        $query =   'DELETE FROM ' . $this->table . ' 
                    WHERE       id = :id';
        
        // Prepare statement
        $statement = $this->connection->prepare($query);
        // clean id
        $this->id  = htmlspecialchars(strip_tags($this->id));
        // Bind id
        $statement->bindParam(':id',$this->id);
        // Execute query
        if($statement->execute()){
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $statement->error);
        return false;
    }


}//end class