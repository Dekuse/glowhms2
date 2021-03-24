<?php
  class Register extends Controller {
    private $db;
    public $repfilepath;
    
    
    public function __construct(){
      $this->db = new Database;
      $this->filer = $this->filemethods('Fileoperations');
    }


    public function getInput($from){
      $this->db->query("SELECT * FROM `".$from."`;");
      $results = $this->db->resultset();

      return $results;
    }

    public function getUserInput($from,$userid){
      $this->db->query("SELECT * FROM `".$from."` WHERE `UserId`=:userid ;");
      $this->db->bind(':userid', $userid);
      $results = $this->db->single();

      return $results;
    }
    public function getAdminInput($from,$userid){
      $this->db->query("SELECT * FROM `".$from."` WHERE `USER_ID`=:userid ;");
      $this->db->bind(':userid', $userid);
      $results = $this->db->single();

      return $results;
    }

    public function login($email, $password){
      
      $this->db->query("SELECT * FROM `user_secured` WHERE `USER_ID` = :GLOWUSER AND `ACCOUNT_STATUS`='EN' ");
    
      $this->db->bind(':GLOWUSER', $email);
     
      //$this->db->bind(':AccountStatus', "Enabled");

      $row = $this->db->single();
      if($this->db->rowCount() > 0){
        $hashed_password = $row->USER_PASSWORD;
        if(password_verify($password, $hashed_password)){
         return $row;
         } else {
           return false;
         }
      } else {
        return false;
      }
  
    }
    public function addLoginLog($source,$user,$UserRole){
        
          
      $this->db->query('INSERT INTO `logs_login`(`SOURCE`, `USER_ID`,`USERTYPE`)
       VALUES (:SOURCE,:USERID,:USERTYPE)');
  
         // Bind Values
     
         $this->db->bind(':SOURCE',$source);
         $this->db->bind(':USERID', $user);
         $this->db->bind(':USERTYPE',$UserRole);
      

           if($this->db->execute()){
            return true;
           } else {
             return false;
           }
          
        
          
        }  
  }