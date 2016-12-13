<?php

/**
 * Description of DbConnect
 *
 * @author student
 */
class DbConnect {

    //create private variables
    private $conn;

    function __construct() {
        //empty constructor
    }

    /**
     * establish database connection
     * @return database connection handler
     */
    function connect() {
        //get the connection info
        require_once dirname($_SERVER['DOCUMENT_ROOT']).'/dbconn/advp_connect.php';

        // make the connection (using the pdo - php data odbjects driver)
        $this->conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

        //SET ERROR reporting - make it throw exceptions
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //return connection resource back to calling enviroment
        return $this->conn;
    }//end of connect method

}//end of class
