<?php
  class Helpmethods extends Controller {
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

    public function getRole(){
      $this->db->query("SELECT `MAJOR_SER_CODE`,`MAJOR_SER_NAME` FROM `role` where `USER_ID`=:USER_ID AND `ROLE_STATUS`=:ROLE_STATUS");
      $this->db->bind(':USER_ID', $_SESSION['user_id']);
      $this->db->bind(':ROLE_STATUS', 'EN');
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
    public function getMajor_ser_code($SERVICE_CODE){
      $this->db->query("SELECT `MAJOR_SER_CODE` FROM `ser_list` WHERE `SERVICE_CODE`=:SERVICE_CODE;");
       $this->db->bind(':SERVICE_CODE', $SERVICE_CODE);
      $result = $this->db->single();
      return $result->MAJOR_SER_CODE;
          }

          public function get_service_owner($MAJOR_SER_CODE){
            $this->db->query("SELECT m.NAME,m.MAJOR_ACTOR,m.QUEUE,m.REQUEST,m.NOTIFICATION,m.RESULT,m.TAG FROM `lu_actor_major` m INNER JOIN `ser_gen_catagory` c ON c.LOCKED_TO = m.MAJOR_ACTOR WHERE C.MAJOR_SER_CODE=:MAJOR_SER_CODE");
             $this->db->bind(':MAJOR_SER_CODE', $MAJOR_SER_CODE);
            $result = $this->db->single();
            
            return $result;
                }

          public  function get_last_id($tablename){
            $this->db->query("SELECT auto_increment FROM INFORMATION_SCHEMA.TABLES WHERE table_name = :tablename;");
            $this->db->bind(':tablename', $tablename);
            $result = $this->db->single();
      
            return $result->auto_increment;
          }

          public function get_noti_detail($SERVICE_CODE ){
            $this->db->query("SELECT `HEADER`,`DESCI` FROM `lu_noti_detail` WHERE `SERVICE_CODE`=:SERVICE_CODE  ;");
            $this->db->bind(':SERVICE_CODE', $SERVICE_CODE );
            $results = $this->db->single();
            return $results;
          }

          public function generate_link($MAJOR_SER_CODE,$REQ_ID,$CUS_ID,$CARD_NO){

            $output = array('data' => array());
            $this->db->query("SELECT `LINK` FROM `ser_gen_catagory` where `MAJOR_SER_CODE`=:MAJOR_SER_CODE ");
            $this->db->bind(':MAJOR_SER_CODE', $MAJOR_SER_CODE);
            $result = $this->db->single();
            $fullcount=$this->db->rowCount();
          $x=1;
          if($fullcount == 0){
         
            return false;
          }
        
          else{
            //$link= URLROOT."/superviser/showsinglerequest?requestid=".  ($maxVisaId[0]['maxid'])."&notiid=". ($result[0]['maxid']+1);

            $link=URLROOT.$result->LINK."?REQ_ID=".($REQ_ID)."&MAJOR_SER_CODE=".($MAJOR_SER_CODE)."&CUS_ID=".($CUS_ID) ."&CARD_NO=".($CARD_NO);
            return $link;
          }
           
          }
      


  }
      
 
  