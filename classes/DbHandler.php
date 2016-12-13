<?php


/**
 * DbHandler.php
 * Class to handle all database operations
 * This class will have the CRUD methods:
 * C - Create
 * R - Read
 * U - Update
 * D - Delete
 *
 * @author mwilliams
 */
class DbHandler {
    //private connection variable
    private $conn;
    
    //Constructor class - runs when class is initialized
    function __construct() {
        //initialize database connection when class is instantiated
        require_once dirname(__FILE__ .'/DbConnect.php');
        //Open database
        try{
            $db = new DbConnect();
            $this->conn = $db->connect();
        } catch (Exception $ex) {
            $this::dbConnectError($ex->getCode());
        }
        
        
    }//end of constructor
    
    
    //A static function allows to make a calls to it without
    //instantiating the class.  In other words with using the 
    //new keyword, for example
    //$dbh = new DbHandler();
    //$dbh->dbConnectError(1045);
    
    //Instead we can call it directly like this
    //$this::dbConnectError(1045);
    private static function dbConnectError($code){
        switch($code){
            case 1045:
                echo "A database access error has occured!";
                break;
            case 2002:
                echo "A database server error has occured!";
                break;
            default:
                echo "An server error has occured!";
                break;
        }
    }//End of DbConnectError 
    
    
    /**
     * getChapterList() function
     * Get a list of categories for creating menu system
     */
    public function getChapterList(){
        $sql = "SELECT chapterID, chapterNumber 
                FROM chapters                
                ORDER BY chapterID";
        try{
            $stmt = $this->conn->query($sql);
            $chapters = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = array('error'=>false,
                           'items'=>$chapters);
            
        } catch (PDOException $ex) {
            $data = array('error'=>true,
                          'message'=>$ex->getMessage()
                    );
        }
        
        //return the data back to calling environment
        return $data;
       
    }
    
    /**
     * getDemoList() function
     * Get a list of categories for creating menu system
     */
    public function getDemoList($id){
        
        $sql = "SELECT demo.chapterID, demo.demoID, demoName, chapterNumber
                FROM demo left join chapters
                on demo.chapterID=chapters.chapterID
                WHERE demo.chapterID=:id";
               
                
        try{
            $stmt = $this->conn->prepare($sql);
            $stmt -> bindValue(':id',$id,PDO::PARAM_INT);
            $stmt-> execute();
            $demos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = array('error'=>false,
                           'items'=>$demos);
            
        } catch (PDOException $ex) {
            $data = array('error'=>true,
                          'message'=>$ex->getMessage()
                    );
        }
        
        //return the data back to calling environment
        return $data;
       
    }

    public function getDemoCode($id){
        $sql = "SELECT demoID, demo_code, demoName 
                FROM demo               
                WHERE demoID=:id";
        try{
             $stmt = $this->conn->prepare($sql);
            $stmt -> bindValue(':id',$id,PDO::PARAM_INT);
            $stmt-> execute();            
            $demo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = array('error'=>false,
                           'items'=>$demo);
            
        } catch (PDOException $ex) {
            $data = array('error'=>true,
                          'message'=>$ex->getMessage()
                    );
        }
        
        //return the data back to calling environment
        return $data;
       
    }
}

//end of class

 

