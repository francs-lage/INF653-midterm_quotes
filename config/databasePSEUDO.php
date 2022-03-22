
<!-- I did provide a link from the Heroku dev center that 
shows how to do this (https://devcenter.heroku.com/articles/jawsdb#pdo), 
but I'm going to outline everything with pseudo (fake) code
 to help out. -->

class Database {
  // Define the class properties here
  // private $conn; for example 

  public function connect() {
    // if creating a Heroku connection, this is straight from the dev center link: 
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');
    //You cannot do the above for your local dev environment, just Heroku

    // Create your new PDO connection here
    // This is also from the Heroku docs showing the PDO connection: 
    try {
      $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    }
    catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }
    // We used this PDO connection format in previous weeks - reference w3schools.com
  }
} 

<!-- UPDATE for the Connection code sample just above: 
    I was a bit sleepy and just pasted code from the 
    Heroku Dev Center in the sample above. Adjust to your situation as Heroku does not assume you are using a class in your code. 
For example, in the try block, you would need $this->conn 
instead of $conn as shown in the example above. 
You may also choose to put some of the assigned variables 
in a constructor for the class like 
$this->url = getenv(etc...) -->