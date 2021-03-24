<?php
  class admin extends Controller {
    private $db;
    public function __construct(){
      $this->db = new Database;
      $this->filer = $this->filemethods('Fileoperations');
    }

   
    public function getUserInfo(){
        $this->db->query("SELECT * FROM `user` WHERE `USER_ID` = :GLOWADMIN ");
        $this->db->bind(':GLOWADMIN', $_SESSION['admin_id']);
        $row = $this->db->single();
        if($this->db->rowCount() > 0){
          return $row;
        } else {
          return false;
        }
    
      }

      public function getmajorbeddata(){
        $output = array('data' => array());
        $this->db->query("SELECT * FROM `bedroom_catagory` ");
        $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
       foreach ($result as $row ) {
        $output['data'][] = array(
          "COUNTER"=>$x,
          "SIZE"=>$fullcount,
         "MAJOR_BDR_CODE"=>$row['MAJOR_BDR_CODE'],
         "MAJOR_BDR_PRICE"=>$row['MAJOR_BDR_PRICE'],
         "MAJOR_BDR_ADDRESS"=>$row['MAJOR_BDR_ADDRESS'],
          "MAJOR_BDR_STATUS"=>$row['MAJOR_BDR_STATUS'],
        );
        $x++;
    
      }
      return $output;
      }

      
      public function getusersdata(){
        $output = array('data' => array());
        $this->db->query("SELECT * FROM `user` ");
        $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
       foreach ($result as $row ) {

        $status;
        if($row['ACTIVE_STATUS']=='F')
        $status='<div id="" class="led-red-on"><div ';
        else
        $status='<div class="led-green"></div>';
        
        $output['data'][] = array(
          "COUNTER"=>$x,
          "SIZE"=>$fullcount,
         "ID"=>$row['ID'],
         "USER_ID"=>$row['USER_ID'],
         "FULL_NAME"=>$row['FULL_NAME'],
          "SEX"=>$row['SEX'],
          "PHONENO"=>$row['PHONENO'],
          "CITY"=>$row['CITY'],
          "EMAIL"=>$row['EMAIL'],
           "NATIONALITY"=>$row['NATIONALITY'],
           "MAJOR_ACTOR"=>$row['MAJOR_ACTOR'],
           "PROFESSION"=>$row['PROFESSION'],
           "DATE_CREATED"=>$row['DATE_CREATED'],
            "DATE_MODIFIED"=>$row['DATE_MODIFIED'],
            "ACCOUNT_STATUS"=>$row['ACCOUNT_STATUS'],
            "ACTIVE_STATUS"=> $status,
        );
        $x++;
    
      }
      return $output;
      }

      public function getroledata(){
        $output = array('data' => array());
        $this->db->query("SELECT * FROM `role` ");
        $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
       foreach ($result as $row ) {
        
        $output['data'][] = array(
          "COUNTER"=>$x,
          "SIZE"=>$fullcount,
         "ID"=>$row['ID'],
         "USER_ID"=>$row['USER_ID'],
         "MAJOR_SER_CODE"=>$row['MAJOR_SER_CODE'],
          "MAJOR_SER_NAME"=>$row['MAJOR_SER_NAME'],
          "DATE_CREATED"=>$row['DATE_CREATED'],
          "DATE_MODIFIED"=>$row['DATE_MODIFIED'],
          "ROLE_STATUS"=>$row['ROLE_STATUS'],
           
        );
        $x++;
    
      }
      return $output;
      }

      public function getservice(){
        $output = array('data' => array());
        $this->db->query("SELECT * FROM `ser_list` ");
        $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
       foreach ($result as $row ) {
        $output['data'][] = array(
          "COUNTER"=>$x,
          "SIZE"=>$fullcount,
         "ID"=>$row['ID'],
         "SERVICE_CODE"=>$row['SERVICE_CODE'],
         "SERVICE_NAME"=>$row['SERVICE_NAME'],
          "MAJOR_SER_CODE"=>$row['MAJOR_SER_CODE'],
          "DATE_CREATE"=>$row['DATE_CREATE'],
          "DATE_MODI"=>$row['DATE_MODI'],
           "DESCI"=>$row['DESCI'],
           "PRICE"=>$row['PRICE'],
           "SERVICE_STATUS"=>$row['SERVICE_STATUS'],
        );
        $x++;
    
      }
      return $output;
      }

      public function getcardpdata(){
        $output = array('data' => array());
        $this->db->query("SELECT * FROM `card_pr_type` ");
        $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
       foreach ($result as $row ) {
        $output['data'][] = array(
          "COUNTER"=>$x,
          "SIZE"=>$fullcount,
         "ID"=>$row['ID'],
         "CARD_PR_TYPE"=>$row['CARD_PR_TYPE'],
         "CARD_PR_DES"=>$row['CARD_PR_DES'],
          "CARD_PR_PRICE"=>$row['CARD_PR_PRICE'],
          "CARD_PR_STATUS"=>$row['CARD_PR_STATUS'],
        );
        $x++;
    
      }
      return $output;
      }

      public function getactordata(){
        $output = array('data' => array());
        $this->db->query("SELECT * FROM `lu_actor_list` ");
        $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
       foreach ($result as $row ) {
        $output['data'][] = array(
          "COUNTER"=>$x,
          "SIZE"=>$fullcount,
         "ID"=>$row['ID'],
         "ACTOR_ID"=>$row['ACTOR_ID'],
         "MAJOR_ACTOR"=>$row['MAJOR_ACTOR'],
          "ACTOR_NAME"=>$row['ACTOR_NAME'],
          "ACTOR_DESCI"=>$row['ACTOR_DESCI'],
          "ACTOR_STATUS"=>$row['ACTOR_STATUS'],
        );
        $x++;
    
      }
      return $output;
      }

      public function getbeddata(){
        $output = array('data' => array());
        $this->db->query("SELECT * FROM `bedroom` ");
        $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
      if($fullcount == 0)
      return false;
      else{
        foreach ($result as $row ) {
          $output['data'][] = array(
            "COUNTER"=>$x,
            "SIZE"=>$fullcount,
           "ID"=>$row['ID'],
           "BEDROOM_TYPE"=>$row['BEDROOM_TYPE'],
           "BEDROOM_PRICE"=>$row['BEDROOM_PRICE'],
           
            "BEDROOM_STATUS"=>$row['BEDROOM_STATUS'],
            "BEDROOM_AVAIBILITY"=>$row['BEDROOM_AVAIBILITY'],
          
          );
          $x++;
      
        }
        return $output;
      }
       
      }

      public function getmajorservice2(){
        
        $output = array('data' => array());
        $this->db->query("SELECT * FROM `ser_gen_catagory`  ");
        $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
      if($fullcount == 0){
     
        return false;
      }
    
      else{
        foreach ($result as $row ) {
        
          $output['data'][] = array(
            "COUNTER"=>$x,
            "SIZE"=>$fullcount,
           "ID"=>$row['ID'],
           "MAJOR_SER_CODE"=>$row['MAJOR_SER_CODE'],
           "SER_NAME"=>$row['SER_NAME'],
           "SER_DESC"=>$row['SER_DESC'],
            "DATE_CREATE"=>$row['DATE_CREATE'],
         
          
          );
          $x++;
      
        }
        
        return $output;
      }
       
      }

      public function getmajoractor(){
        $this->db->query("SELECT * FROM `lu_actor_major`  ");
        $result = $this->db->resultset();
        
      return $result;
      }

      public function getactorlist(){
        $this->db->query("SELECT ACTOR_ID,ACTOR_NAME,ACTOR_DESCI FROM `lu_actor_list` WHERE ACTOR_STATUS='EN'  ");
        $result = $this->db->resultset();
        
      return $result;
      }

      public function getuserlist(){
        $this->db->query("SELECT USER_ID,FULL_NAME,MAJOR_ACTOR FROM `user`  ");
        $result = $this->db->resultset();
        
      return $result;
      }

      public function getmajorservice(){
        $this->db->query("SELECT * FROM `ser_gen_catagory`  ");
        $result = $this->db->resultset();
        
      return $result;
      }

      public function getsinglemser($MAJOR_SER_CODE){
        $this->db->query("SELECT SER_NAME FROM `ser_gen_catagory`  where MAJOR_SER_CODE=:MAJOR_SER_CODE");
        $this->db->bind(':MAJOR_SER_CODE', $MAJOR_SER_CODE);
        $result = $this->db->single();
        
      return $result;
      }

      public function getmajorbeddata2(){
        $this->db->query("SELECT * FROM `bedroom_catagory` where MAJOR_BDR_STATUS='EN' ");
        $result = $this->db->resultset();
        
      return $result;
      }

      public function nation(){
        $this->db->query("SELECT * FROM `bedroom_catagory` where MAJOR_BDR_STATUS='EN' ");
        $result = $this->db->resultset();
        
      return $result;
      }
      
      public function addmabed($data){
 
        // Prepare Query 
   $this->db->query('INSERT INTO `bedroom_catagory`(`MAJOR_BDR_CODE`, `MAJOR_BDR_PRICE`, `MAJOR_BDR_ADDRESS`) 
   VALUES (:MAJOR_BDR_CODE,:bdprice,:bdaddress)');

   // Bind Values
   $this->db->bind(':MAJOR_BDR_CODE', $data['MAJOR_BDR_CODE']);
   $this->db->bind(':bdprice', $data['bdprice']);
   $this->db->bind(':bdaddress', $data['bdaddress']);
  

   
   //Execute
   if($this->db->execute()){
     return true;
   } else {
     return false;
   }
   }

   public function adduser($data){
 
    // Prepare Query 
$this->db->query('INSERT INTO `user`(`USER_ID`, `FULL_NAME`, `SEX`,`PHONENO`, `CITY`, `EMAIL`,`NATIONALITY`, `MAJOR_ACTOR`, `PROFESSION`) 
VALUES (:USER_ID,:FULL_NAME,:SEX,:PHONENO,:CITY,:EMAIL,:NATIONALITY,:MAJOR_ACTOR,:PROFESSION)');

// Bind Values
$this->db->bind(':USER_ID', $data['USER_ID']);
$this->db->bind(':FULL_NAME', $data['FULL_NAME']);
$this->db->bind(':SEX', $data['SEX']);
$this->db->bind(':PHONENO', $data['PHONENO']);
$this->db->bind(':CITY', $data['CITY']);
$this->db->bind(':EMAIL', $data['EMAIL']);
$this->db->bind(':NATIONALITY', $data['NATIONALITY']);
$this->db->bind(':MAJOR_ACTOR', $data['MAJOR_ACTOR']);
$this->db->bind(':PROFESSION', $data['PROFESSION']);



//Execute
if($this->db->execute()){
 return true;
} else {
 return false;
}
}

   public function addservicedata($data){
 
    // Prepare Query 
$this->db->query('INSERT INTO `ser_list`(`SERVICE_CODE`, `SERVICE_NAME`, `MAJOR_SER_CODE`, `DESCI`, `PRICE`) 
VALUES (:SERVICE_CODE,:SERVICE_NAME,:MAJOR_SER_CODE,:DESCI,:PRICE)');

// Bind Values
$this->db->bind(':SERVICE_CODE', $data['SERVICE_CODE']);
$this->db->bind(':SERVICE_NAME', $data['SERVICE_NAME']);
$this->db->bind(':MAJOR_SER_CODE', $data['MAJOR_SER_CODE']);
$this->db->bind(':DESCI', $data['DESCI']);
$this->db->bind(':PRICE', $data['PRICE']);



//Execute
if($this->db->execute()){
 return true;
} else {
 return false;
}
}

   public function addcardp($data){
 
    // Prepare Query 
$this->db->query('INSERT INTO `card_pr_type`(`CARD_PR_TYPE`, `CARD_PR_DES`, `CARD_PR_PRICE`) 
VALUES (:CARD_PR_TYPE,:CARD_PR_DES,:CARD_PR_PRICE)');

// Bind Values
$this->db->bind(':CARD_PR_TYPE', $data['CARD_PR_TYPE']);
$this->db->bind(':CARD_PR_DES', $data['CARD_PR_DES']);
$this->db->bind(':CARD_PR_PRICE', $data['CARD_PR_PRICE']);



//Execute
if($this->db->execute()){
 return true;
} else {
 return false;
}
}

public function addrole($data){
 
  // Prepare Query 
$this->db->query('INSERT INTO `role`(`USER_ID`, `MAJOR_SER_CODE`, `MAJOR_SER_NAME`) 
VALUES (:USER_ID,:MAJOR_SER_CODE,:MAJOR_SER_NAME)');

// Bind Values
$this->db->bind(':USER_ID', $data['USER_ID']);
$this->db->bind(':MAJOR_SER_CODE', $data['MAJOR_SER_CODE']);
$this->db->bind(':MAJOR_SER_NAME', $data['MAJOR_SER_NAME']);



//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function addactor($data){
 
  // Prepare Query 
$this->db->query('INSERT INTO `lu_actor_list`(`ACTOR_ID`, `MAJOR_ACTOR`, `ACTOR_NAME`, `ACTOR_DESCI`) 
VALUES (:ACTOR_ID,:MAJOR_ACTOR,:ACTOR_NAME,:ACTOR_DESCI)');

// Bind Values
$this->db->bind(':ACTOR_ID', $data['ACTOR_ID']);
$this->db->bind(':MAJOR_ACTOR', $data['MAJOR_ACTOR']);
$this->db->bind(':ACTOR_NAME', $data['ACTOR_NAME']);
$this->db->bind(':ACTOR_DESCI', $data['ACTOR_DESCI']);


//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}


   public function addbed($data){
    $this->db->query("SELECT * FROM `bedroom_catagory` where `MAJOR_BDR_CODE`=:MAJOR_BDR_CODE ");
    $this->db->bind(':MAJOR_BDR_CODE', $data['mabedtype']);
    $result = $this->db->single();
 
    // Prepare Query 
 $this->db->query('INSERT INTO `bedroom`( `BEDROOM_TYPE`, `BEDROOM_PRICE`) 
 VALUES (:BEDROOM_TYPE,:BEDROOM_PRICE)');

 $this->db->bind(':BEDROOM_TYPE',$result->MAJOR_BDR_CODE);
 $this->db->bind(':BEDROOM_PRICE',$result->MAJOR_BDR_PRICE);
 if($this->db->execute()){
  return true;
} else {
  return false;
}

}

   public function disablemabed($data){
     
    // Prepare Query
$this->db->query('UPDATE `bedroom_catagory` SET `MAJOR_BDR_STATUS`=:MAJOR_BDR_STATUS WHERE `MAJOR_BDR_CODE`=:MAJOR_BDR_CODE');

// Bind Values
$this->db->bind(':MAJOR_BDR_STATUS', "DI");
$this->db->bind(':MAJOR_BDR_CODE', $data['userId']);
//Execute
if($this->db->execute()){
 return true;
} else {
 return false;
}
}

public function disableuser($data){
     
  // Prepare Query
$this->db->query('UPDATE `user` SET `ACCOUNT_STATUS`=:ACCOUNT_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':ACCOUNT_STATUS', "DI");
$this->db->bind(':ID', $data['ID']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function enableuser($data){
     
  // Prepare Query
$this->db->query('UPDATE `user` SET `ACCOUNT_STATUS`=:ACCOUNT_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':ACCOUNT_STATUS', "EN");
$this->db->bind(':ID', $data['ID']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function disableser($data){
     
  // Prepare Query
$this->db->query('UPDATE `ser_list` SET `SERVICE_STATUS`=:SERVICE_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':SERVICE_STATUS', "DI");
$this->db->bind(':ID', $data['ID']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function enableser($data){
     
  // Prepare Query
$this->db->query('UPDATE `ser_list` SET `SERVICE_STATUS`=:SERVICE_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':SERVICE_STATUS', "EN");
$this->db->bind(':ID', $data['ID']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function disablecardp($data){
     
  // Prepare Query
$this->db->query('UPDATE `card_pr_type` SET `CARD_PR_STATUS`=:CARD_PR_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':CARD_PR_STATUS', "DI");
$this->db->bind(':ID', $data['ID']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function disableactor($data){
     
  // Prepare Query
$this->db->query('UPDATE `lu_actor_list` SET `ACTOR_STATUS`=:ACTOR_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':ACTOR_STATUS', "DI");
$this->db->bind(':ID', $data['ID']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function enablecardp($data){
     
  // Prepare Query
$this->db->query('UPDATE `card_pr_type` SET `CARD_PR_STATUS`=:CARD_PR_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':CARD_PR_STATUS', "EN");
$this->db->bind(':ID', $data['ID']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function enableactor($data){
     
  // Prepare Query
$this->db->query('UPDATE `lu_actor_list` SET `ACTOR_STATUS`=:ACTOR_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':ACTOR_STATUS', "EN");
$this->db->bind(':ID', $data['ID']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function disablebed($data){
     
  // Prepare Query
$this->db->query('UPDATE `bedroom` SET `BEDROOM_STATUS`=:BEDROOM_STATUS WHERE `ID`=:ID');

// Bind Values
$this->db->bind(':BEDROOM_STATUS', "DI");
$this->db->bind(':ID', $data['userId']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function enablemabed($data){
     
  // Prepare Query
$this->db->query('UPDATE `bedroom_catagory` SET `MAJOR_BDR_STATUS`=:MAJOR_BDR_STATUS WHERE `MAJOR_BDR_CODE`=:MAJOR_BDR_CODE');

// Bind Values
$this->db->bind(':MAJOR_BDR_STATUS', "EN");
$this->db->bind(':MAJOR_BDR_CODE', $data['userId']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function enablebed($data){
     
  // Prepare Query
$this->db->query('UPDATE `bedroom` SET `BEDROOM_STATUS`=:BEDROOM_STATUS WHERE `ID`=:ID');
// Bind Values
$this->db->bind(':BEDROOM_STATUS', "EN");
$this->db->bind(':ID', $data['userId']);
//Execute
if($this->db->execute()){
return true;
} else {
return false;
}
}

public function changeMabed($data){
  $this->db->query('UPDATE `bedroom_catagory` SET `MAJOR_BDR_PRICE`=:MAJOR_BDR_PRICE, `MAJOR_BDR_ADDRESS`=:MAJOR_BDR_ADDRESS WHERE `MAJOR_BDR_CODE`=:MAJOR_BDR_CODE');
  $this->db->bind(':MAJOR_BDR_PRICE', $data['newprice']);
  $this->db->bind(':MAJOR_BDR_ADDRESS', $data['newaddress']);
  $this->db->bind(':MAJOR_BDR_CODE', $data['MAJOR_BDR_CODE']);
  if($this->db->execute())
     return true;
   else{
     return false;
   }
  } 

  public function changeuser($data){
    $this->db->query('UPDATE `user` SET `FULL_NAME`=:FULL_NAME, `SEX`=:SEX,`PHONENO`=:PHONENO, `CITY`=:CITY,`EMAIL`=:EMAIL, `NATIONALITY`=:NATIONALITY,`MAJOR_ACTOR`=:MAJOR_ACTOR, `PROFESSION`=:PROFESSION, `DATE_MODIFIED`=:DATE_MODIFIED WHERE `ID`=:ID');
    $this->db->bind(':FULL_NAME', $data['FULL_NAME']);
    $this->db->bind(':ID', $data['ID']);
    $this->db->bind(':SEX', $data['SEX']);
    $this->db->bind(':PHONENO', $data['PHONENO']);
    $this->db->bind(':CITY', $data['CITY']);
    $this->db->bind(':EMAIL', $data['EMAIL']);
    $this->db->bind(':NATIONALITY', $data['NATIONALITY']);
    $this->db->bind(':MAJOR_ACTOR', $data['MAJOR_ACTOR']);
    $this->db->bind(':PROFESSION', $data['PROFESSION']);
    $this->db->bind(':DATE_MODIFIED', date('Y-m-d H:i:s'));
    if($this->db->execute())
       return true;
     else{
       return false;
     }
    } 

    public function addusersecured($data){
      $hashedPassword = password_hash($data['USER_PASSWORD'], PASSWORD_DEFAULT);
    $this->db->query('INSERT INTO `user_secured`( `USER_ID`, `USER_TYPE`, `USER_PASSWORD`) 
    VALUES (:USER_ID,:USER_TYPE,:USER_PASSWORD)');

    // Bind Values
    $this->db->bind(':USER_ID', $data['USER_ID']);
    $this->db->bind(':USER_TYPE', $data['USER_TYPE']);
    $this->db->bind(':USER_PASSWORD', $hashedPassword);

    //Execute
    if($this->db->execute()){
      return true;
    } else {
      return false;
    }
    }

    public function changeuserpass($data){
      $hashedPassword = password_hash($data['firstPassword'], PASSWORD_DEFAULT);
       $this->db->query('UPDATE `user_secured` SET `USER_PASSWORD`=:USER_PASSWORD WHERE `ID`=:ID');
       
 
       // Bind Values
       $this->db->bind(':USER_PASSWORD', $hashedPassword);
       $this->db->bind(':ID', $data['ID']);
       if($this->db->execute()){
         return true;
       } else {
         return false;
       }
       }

  public function changeser($data){
    $this->db->query('UPDATE `ser_list` SET `SERVICE_NAME`=:SERVIC_NAME,`MAJOR_SER_CODE`=:MAJOR_SER_CODE ,`DATE_MODI`=:DATE_MODI , `DESCI`=:DESCI , `PRICE`=:PRICE WHERE `ID`=:ID');
    $this->db->bind(':ID', $data['ID']);
    $this->db->bind(':SERVIC_NAME', $data['SERVICE_NAME']);
    $this->db->bind(':MAJOR_SER_CODE', $data['MAJOR_SER_CODE']);
    $this->db->bind(':DATE_MODI', date('Y-m-d'));
    $this->db->bind(':DESCI', $data['DESCI']);
    $this->db->bind(':PRICE', $data['PRICE']);
    if($this->db->execute())
       return true;
     else{
       return false;
     }
    } 

  public function changecardp($data){
    $this->db->query('UPDATE `card_pr_type` SET `CARD_PR_PRICE`=:editCARD_PR_PRICE, `CARD_PR_DES`=:editCARD_PR_DES WHERE `ID`=:ID');
    $this->db->bind(':ID', $data['ID']);
    $this->db->bind(':editCARD_PR_DES', $data['editCARD_PR_DES']);
    $this->db->bind(':editCARD_PR_PRICE', $data['editCARD_PR_PRICE']);
    if($this->db->execute())
       return true;
     else{
       return false;
     }
    } 

    public function changeactor($data){
      $this->db->query('UPDATE `lu_actor_list` SET `MAJOR_ACTOR`=:edit_MAJOR_ACTOR, `ACTOR_NAME`=:edit_ACTOR_NAME , `ACTOR_DESCI`=:edit_ACTOR_DESCI WHERE `ID`=:ID');
      $this->db->bind(':ID', $data['ID']);
      $this->db->bind(':edit_MAJOR_ACTOR', $data['edit_MAJOR_ACTOR']);
      $this->db->bind(':edit_ACTOR_NAME', $data['edit_ACTOR_NAME']);
      $this->db->bind(':edit_ACTOR_DESCI', $data['edit_ACTOR_DESCI']);
      if($this->db->execute())
         return true;
       else{
         return false;
       }
      } 

  public function editbed($data){
    $this->db->query("SELECT * FROM `bedroom_catagory` where `MAJOR_BDR_CODE`=:MAJOR_BDR_CODE ");
    $this->db->bind(':MAJOR_BDR_CODE', $data['editbedtype']);
    $result = $this->db->single();
 
    $this->db->query('UPDATE `bedroom` SET `BEDROOM_TYPE`=:BEDROOM_TYPE,`BEDROOM_PRICE`=:BEDROOM_PRICE WHERE `ID`=:ID');
    
    $this->db->bind(':BEDROOM_TYPE', $data['editbedtype']);
    $this->db->bind(':BEDROOM_PRICE',$result->MAJOR_BDR_PRICE);
    $this->db->bind(':ID', $data['id']);
    if($this->db->execute())
       return true;
     else{
       return false;
     }
    } 
  
  }