<?php
class Quote{
    // Database  (>>>1st.video: 13'10" <<<)
    private $connection;
    private $table = 'quotes';
    // Quote Properties
    public $id;
    public $quote;
    public $authorId;
    public $author;
    public $categoryId;
    public $category;
    
    // Constructor with DB
    public function __construct($db){
        $this->connection = $db;
    }

    // Get all quotes
    public function read(){
        // query read all quotes
        $query = 'SELECT quotes.id, quotes.quote, authors.author, categories.category
                  FROM ' . $this->table . '
                  LEFT JOIN authors ON authors.id = quotes.authorId
                  LEFT JOIN categories on categories.id = quotes.categoryId
                  ORDER BY quotes.id';

        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Execute query
        $statement->execute();
        return $statement;
    }

    // Get Single Quote (>>>> 2nd video: 1'20" <<<<<<<)
    public function read_single(){
        // query read single_quote
        $query = 'SELECT quotes.id, quotes.quote, authors.author, categories.category
                  FROM ' . $this->table . '
                  LEFT JOIN authors ON authors.id = quotes.authorId
                  LEFT JOIN categories on categories.id = quotes.categoryId
                  WHERE quotes.id = ?
                  LIMIT 0,1';
                  
        // Prepare statement
        $statement = $this->connection->prepare($query);
        // Bind Id
        $statement->bindParam(1, $this->id);
        // Execute query
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        // Set properties
        $this->id       = $row['id'];
        $this->quote    = $row['quote'];
        $this->author   = $row['author'];
        $this->category = $row['category'];
    }// end single_quote

/*>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<*/
    // Create Quote  (>>>> 2nd video: 10'15"<<<<)
    public function create(){
      // Create query
      $query = 'INSERT INTO ' . $this->table . '
                SET 
                  quote      = :quote,
                  authorId   = :authorId,
                  categoryId = :categoryId';

      // Prepare statement
      $statement = $this->connection->prepare($query);
      // Clean data
      $this->quote      = htmlspecialchars(strip_tags($this->quote));
      $this->authorId   = htmlspecialchars(strip_tags($this->authorId));
      $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
      // Bind data  ( video 2 - min 14:10)
      $statement->bindParam(':quote',      $this->quote);
      $statement->bindParam(':authorId',   $this->authorId);
      $statement->bindParam(':categoryId', $this->categoryId);
      // Execute query
      if($statement->execute()){
        return true;
      }
      // Print error if something goes wrong
      printf("Error: %s.\n", $statement->error);
      return false;
    }
    /* >>>>>>>>>>>> end 2nd video: 16:20, next create.php <<<<<<<<<<<<< */

    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<*/
    // Update Quote  (>>>> 3nd video: 0'00"<<<<)
    public function update(){
      // Create query
      $query = 'UPDATE ' . $this->table . '
                SET 
                  quote      = :quote,
                  authorId   = :authorId,
                  categoryId = :categoryId
                WHERE
                  id = :id';

      // Prepare statement
      $statement = $this->connection->prepare($query);
      // Clean data
      $this->quote      = htmlspecialchars(strip_tags($this->quote));
      $this->authorId   = htmlspecialchars(strip_tags($this->authorId));
      $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
      $this->id         = htmlspecialchars(strip_tags($this->id));
      // Bind data  
      $statement->bindParam(':quote',      $this->quote);
      $statement->bindParam(':authorId',   $this->authorId);
      $statement->bindParam(':categoryId', $this->categoryId);
      $statement->bindParam(':id',         $this->id);
      // Execute query
      if($statement->execute()){
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $statement->error);

      return false;
    }
    /* >>>>>>> end 3nd video: 2'22", next quotes/update.php <<<<<<<<<< */

    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<*/
    // Delete Quote  (>>>> 3nd video: 5'10"<<<<) 
    public function delete(){
      // create query
      $query = 'DELETE FROM ' . $this->table . ' 
                WHERE id = :id';
      
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
    } /*(>>>>>> end 3nd video: 7'05" next delete.php >>>>)*/
    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<*/
    public function read_author(){
      // query read single_quote
      $query = 'SELECT quotes.id, quotes.quote, authors.author, categories.category
                FROM ' . $this->table . '
                LEFT JOIN authors ON authors.id = quotes.authorId
                LEFT JOIN categories on categories.id = quotes.categoryId
                WHERE quotes.authorId = ?';
                
      // Prepare statement
      $statement = $this->connection->prepare($query);
      // Bind authorId
      $statement->bindParam(1, $this->authorId);
      // Execute query
      $statement->execute();
      return $statement;
  }// end single_author

    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<*/

    public function read_category(){
      // query read all quotes from a specifica category
      $query = 'SELECT quotes.id, quotes.quote, authors.author, categories.category
                FROM ' . $this->table . '
                LEFT JOIN authors ON authors.id = quotes.authorId
                LEFT JOIN categories on categories.id = quotes.categoryId
                WHERE quotes.categoryId = ?';
                
      // Prepare statement
      $statement = $this->connection->prepare($query);
      // Bind authorId
      $statement->bindParam(1, $this->categoryId);
      // Execute query
      $statement->execute();
      return $statement;
  }// end read_category

    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<*/

  public function read_comb(){
    
    $query = 'SELECT quotes.id, quotes.quote, authors.author, categories.category
              FROM ' . $this->table . '
              LEFT JOIN authors ON authors.id = quotes.authorId
              LEFT JOIN categories ON categories.id = quotes.categoryId
              WHERE quotes.authorId   = :authorId 
              AND   quotes.categoryId = :categoryId';
              
    // Prepare statement
    $statement = $this->connection->prepare($query);
    // Bind categoryId

    $statement->bindParam(':authorId',   $this->authorId);
    $statement->bindParam(':categoryId', $this->categoryId);
    // Execute query
    $statement->execute();
    return $statement;
}// end single_category

}/*end of the class Quote */