<?php
  class sys extends Controller {
    private $db;
    public function __construct(){
      $this->db = new Database;
      $this->filer = $this->filemethods('Fileoperations');
    }



     public function visaExcute($fullname,$visaNumber,$daysLeft){
    if($daysLeft<=-1){
      $this->db->query('UPDATE `alienvisa` SET `DaysLeft`=:DaysLeft WHERE `VisaNo`=:VisaNo');
            $this->db->bind(':VisaNo', $visaNumber);
            $this->db->bind(':DaysLeft',($daysLeft-1));
         if($this->db->execute()){
           return true;
         } else {
           return false;
         }
    }
    if($daysLeft>=0){
      $this->db->query('UPDATE `alienvisa` SET `DaysLeft`=:DaysLeft WHERE `VisaNo`=:VisaNo');
            $this->db->bind(':VisaNo', $visaNumber);
            $this->db->bind(':DaysLeft',($daysLeft-1));
         if($this->db->execute()){
          if(($daysLeft-1)<=-1){
            $this->db->query('UPDATE `alienvisa` SET `ExpieryStatus`=:ExpieryStatus WHERE `VisaNo`=:VisaNo');
            $this->db->bind(':VisaNo', $visaNumber);
            $this->db->bind(':ExpieryStatus','Expired');
            if($this->db->execute()){
              $this->db->query('INSERT INTO `departurenotifications`( `Header`, `Description`, `AffectedObject`, `RequestBy`)
               VALUES (:Header,:Desci,:AffectedObject,:RequestBy)');
          $desci= 'Visa Has Expired for customer'." ". $fullname;
             $this->db->bind(':Header','Visa Expired');
             $this->db->bind(':Desci', $desci);
             $this->db->bind(':AffectedObject',$visaNumber);
             $this->db->bind(':RequestBy', 'SYSTEM');

               if($this->db->execute()){
                return true;
               } else {
                 return false;
               }
            }else {
              return false;
            }
          }else {
            return false;
          }
         } else {
           return false;
         }
    }

     }
     public function passExcute($passNumber,$daysLeft){
      if($daysLeft<=-1){
        $this->db->query('UPDATE `alienpassport` SET `DaysLeft`=:DaysLeft WHERE `PassportNo`=:PassportNo');
              $this->db->bind(':PassportNo', $passNumber);
              $this->db->bind(':DaysLeft',($daysLeft-1));
           if($this->db->execute()){
             return true;
           } else {
             return false;
           }
      }
      if($daysLeft>=0){
        $this->db->query('UPDATE `alienpassport` SET `DaysLeft`=:DaysLeft WHERE `PassportNo`=:PassportNo');
              $this->db->bind(':PassportNo', $passNumber);
              $this->db->bind(':DaysLeft',($daysLeft-1));
           if($this->db->execute()){
            if(($daysLeft-1)<=-1){
              $this->db->query('UPDATE `alienpassport` SET `ExpieryStatus`=:ExpieryStatus WHERE `VisaNo`=:VisaNo');
              $this->db->bind(':VisaNo', $passNumber);
              $this->db->bind(':ExpieryStatus','Expired');
           
            } else {
              return false;
            }
           } else {
             return false;
           }
      }
  
       }
     public function getAllVisaData(){
      $output = array('data' => array());
      $this->db->query("SELECT `DaysLeft`, `VisaNo`,`SurName`, `GivenName` FROM `alienvisa` WHERE `IsTerminated`='No' ");
      
      $result = $this->db->resultsetASSO();
      $fullcount=$this->db->rowCount();
      if($fullcount > 0){
        foreach ($result as $row ) {
          $fullname=$row['SurName']." ".$row['GivenName'];
     $output['data'][] = array(
                "size"=>$fullcount,
                "fullname"=>$fullname,
                "visaNo"=>$row['VisaNo'],
                "daysleft"=>$row['DaysLeft'],
                 
          );
        
      
        }
        return $output;
      }
  else{
    return false;
  }
  
    }

    public function getAllPassData(){
      $output = array('data' => array());
      $this->db->query("SELECT `PassportNo`, `DaysLeft` FROM `alienpassport` WHERE `ExpieryStatus`='Not Expired' ");
      
      $result = $this->db->resultsetASSO();
      $fullcount=$this->db->rowCount();
      if($fullcount > 0){
        foreach ($result as $row ) {
       
     $output['data'][] = array(
                "size"=>$fullcount,
                "PassportNo"=>$row['PassportNo'],
                "DaysLeft"=>$row['DaysLeft'],
                 
          );
        
      
        }
        return $output;
      }
  else{
    return false;
  }
  
    }
    public function reset(){
      $hashedPassword = password_hash('123456789', PASSWORD_DEFAULT);
       $this->db->query('UPDATE `oraccsecured` SET `OraccPassword`=:OraccPassword WHERE `OraccUser`="Admin7856"');
       
 
       // Bind Values
       $this->db->bind(':OraccPassword', $hashedPassword);
       if($this->db->execute()){
         return true;
       } else {
         return false;
       }
       }
  }