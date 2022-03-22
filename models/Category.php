<?php
// >>>>>>>> 3rd video 9'10" <<<<<<<<<<<<<<
class Category{
    // Database 
    private $connection;
    private $table = 'categories';

    // Properties
    public $id;
    public $category;

    // Constructor with DB
    public function __construct($db){
        $this->connection = $db;
    }

    // Get all categories
    public function read(){
        //create query
        $query =   'SELECT categories.id, categories.category
                    FROM ' . $this->table . '
                    ORDER BY categories.id';
        
        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Execute query
        $statement->execute();
        return $statement;
    } /* (>>>>>>>>>> ends 13'00" next categories/read.php <<<<<<<) */

    // Get single categories
    public function read_single(){
        //create query
        $query =   'SELECT categories.id, categories.category
                    FROM ' . $this->table . '
                    WHERE categories.id = ?
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
        $this->category = $row['category'];
    }

    // Create Category  
    public function create(){
        // Create query
        $query =   'INSERT INTO ' . $this->table . '
                    SET category = :category';

        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));
        // Bind data  
        $statement->bindParam(':category', $this->category);
        // Execute query
        if($statement->execute()){
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $statement->error);
        return false;
    }

    // Update Category
    public function update(){
        // Create query
        $query =   'UPDATE  ' . $this->table . '
                            SET category = :category
                    WHERE   id = :id';

        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Clean data
        $this->id         = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
        // Bind data  
        $statement->bindParam(':id',         $this->id);
        $statement->bindParam(':category', $this->category);
        // Execute query
        if($statement->execute()){
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $statement->error);

        return false;
    }

    // Delete Category 
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