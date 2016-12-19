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
 * @author fabien and stephanie
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
     * Get a list of chapters for creating menu system
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
     * Get a list of demos for creating menu system
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
    
     public function createUser($email, $password, $first_name, $last_name) {        

        // First check if user already existed in db
        if (!$this->isUserExists($email)) {
            // Generating password hash
            $password_hash = PassHash::hash($password);

            // Make activation code
            $active = md5(uniqid(rand(), true));

            $stmt = $this->conn->prepare("INSERT INTO users(email,pass,first_name,last_name,date_expires,active) values(:email, :pass, :fname, :lname, SUBDATE(NOW(), INTERVAL 1 DAY), :active)");

            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':pass', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':fname', $first_name, PDO::PARAM_STR);
            $stmt->bindValue(':lname', $last_name, PDO::PARAM_STR);
            $stmt->bindValue(':active', $active, PDO::PARAM_STR);

            $result = $stmt->execute();


            // Check for successful insertion

            if ($result) {
                // User successfully inserted
                $data = array(
                    'error' => false,
                    'message' => 'USER_CREATE_SUCCESS',
                    'active' => $active
                );
            } else {
                // Failed to create user
                $data = array(
                    'error' => true,
                    'message' => 'USER_CREATE_FAIL',
                );
            }
        } else {
            // User with same email already existed in the db
            $data = array(
                'error' => true,
                'message' => 'USER_ALREADY_EXISTS'
            );
        }

        return $data;
    }   

    /**
     * getUserByEmail
     * @param type $email
     * @return type
     */
    public function getUserByEmail($email) {
        try {
            $stmt = $this->conn->prepare("SELECT id, type, email, first_name, last_name, active,
                                         IF(date_expires>=NOW(),true,false) as notexpired,
                                         IF(type='admin',true,false)as admin
                                         FROM users WHERE email = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //return $user;
                $data = array('error'=>false,
                              'items'=>$user); 
                return $data;
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            return NULL;
        }
    }
    /**
     * 
     * @param type $email
     * @param type $active
     * @return string
     */
    public function activateUser($email,$active){
        if($this->isUserExists($email)){
            //user exists = update the user info (date_expires, active)
            $stmt=$this->conn->prepare("UPDATE users SET active=NULL, date_expires=ADDDATE(date_expires, INTERVAL 1 YEAR)
                                       WHERE email=:email AND active=:active");
            
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':active', $active, PDO::PARAM_STR);
            
            $result = $stmt->execute();
            $count = $stmt->rowCount();
            
            //check for successful
            if($count>0){
                //user successful 
                $data = array('error'=>false,
                              'message'=>'USER_ACTIVE_SUCCESS');
            }else{
                //failed to acitvate
                $data=array('error'=>true,
                        'message'=>'USER_ACTICE_FAIL');
            }
        }else{
            //account does not exist
            $data=array('error'=>true,
                        'message'=>'USER_ACTICE_FAIL');
        }
        return $data;
        
    }//end activeUser
    
    public function checkLogin($email, $password) {
      
        //1. Check if email exists

        $stmt = $this->conn->prepare("SELECT COUNT(*) from users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $num_rows = $stmt->fetchColumn();
        //var_dump($num_rows);
        //exit();
        if ($num_rows > 0) {
            //2. Actual query
            $stmt = $this->conn->prepare("SELECT pass from users WHERE email = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);

            if (PassHash::check_password($row->pass, $password)) {
                // User password is correct
                return TRUE;
            } else {
                // user password is incorrect
                return FALSE;
            }
        } else {
            // user not existed with the email
            return FALSE;
        }
    }   

    /**
     * Checking for duplicate user by email address
     * @param String $email email to check in db
     * @return boolean
     */
    private function isUserExists($email) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) from users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $num_rows = $stmt->fetchColumn();

        return $num_rows > 0;
    }
    
    // search box
     public function getSearch($s) {
        try {

            $sql = "SELECT demoID, demoName, chapterID 
                    FROM demo                     
                    WHERE demoName like '%$s%'";

            $stmt = $this->conn->query($sql);
            $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = array(
                'error' => false,
                'items' => $search
            );
        } catch (Exception $ex) {
            $data = array(
                'error' => true,
                'message' => $ex->getMessage()
            );
        }
        return $data;
    }

}


//end of class

 

