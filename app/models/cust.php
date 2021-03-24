<?php
  class cust extends Controller {
    private $db;
    public function __construct(){
      $this->db = new Database;
      $this->filer = $this->filemethods('Fileoperations');
      $this->help = $this->model('helpmethods');
    }

   
    public function getUserInfo(){
        $this->db->query("SELECT * FROM `user` WHERE `USER_ID` = :GLOWUSER ");
        $this->db->bind(':GLOWUSER', $_SESSION['user_id']);
        $row = $this->db->single();
        if($this->db->rowCount() > 0){
          return $row;
        } else {
          return false;
        }
    
      }
      public function getcusdata($date1,$date2,$customername,$customerid,$userid){
          $date1=$date1." 00:00:00";
          $date2=trim($date2." 23:59:59");
     
        $query="SELECT * FROM `customer_detail` WHERE `REG_DATE` BETWEEN '".$date1."' AND '".$date2."'  ";

            if($customername != null ){
              $query.="OR `CUS_NAME` LIKE '".$customername."' ";
            }
            if($customerid != null ){
              $query.="OR `CUS_ID`='".$customerid."' ";
            
            }
            if($userid != null ){
              $query.="OR `USER_ID`='".$userid."'";
        
            }
            $query.='ORDER BY `ID` DESC';
         $this->db->query($query);
         $result = $this->db->resultsetASSO();
        $fullcount=$this->db->rowCount();
      $x=1;
      
      if($result!=NULL){
        foreach ($result as $row ) {

          if($this->check_card_avai( $row['CUS_ID']) != false){
						
            $Card='<a   onclick="showCard(\''.$row['CUS_ID'].'\')" class="" style="list-style-type:none"> Show Data</a>';
          }
          else{
            $Card='No Data';
        
          }
          $output['data'][] = array(
            "SIZE"=>$fullcount,
           "ID"=>$row['ID'],
           "CUS_ID"=>$row['CUS_ID'],
           "USER_ID"=>$row['USER_ID'],
            "CUS_NAME"=>$row['CUS_NAME'],
            "SEX"=>$row['SEX'],
            "AGE"=>$row['AGE'],
            "PHONENO"=>$row['PHONENO'],
             "REGION"=>$row['REGION'],
             "CITY"=>$row['CITY'],
             "NATIONALITY"=>$row['NATIONALITY'],
              "REG_DATE"=>$row['REG_DATE'],
              "CARD_STATUS"=>$Card,
          );
        }
        return $output;
      }
      else{
        $output['data'][] = array(
          "OUTPUT"=>false
                );
                return $output;
      }
      }

      public function getappdata($date1,$date2,$apptype,$appstatus,$cardno){
        $date1=$date1." 00:00:00";
        $date2=trim($date2." 23:59:59");
   
      $query="SELECT * FROM `appoint_cus` WHERE `APPOINT_DATETIME` BETWEEN '".$date1."' AND '".$date2."' AND `APPOINT_TYPE`='".$apptype."' AND `APPOINT_STATUS`='".$appstatus."' ";

          if($cardno != null ){
            $query.="OR `CARD_NO` LIKE '".$cardno."' ";
          }
         
          $query.='ORDER BY `ID` DESC';
        
       $this->db->query($query);
       $result = $this->db->resultsetASSO();
      $fullcount=$this->db->rowCount();
    $x=1;
    
    if($result!=NULL){
      foreach ($result as $row ) {
        $userid='<a   data-toggle="modal" data-target="#showUserModal" onclick="showUser(\''.$row['USER_ID'].'\')" class="" style="list-style-type:none"> '.$row['USER_ID']. '</a>';

       
        if($row['LEFT_TIME'] == 0){
          
          $process='<a   onclick="processApp(\''.$row['CUS_APPOINT_ID'].'\')" class="" style="list-style-type:none"> Process App</a>';
        }
        else{
          $process='No Options';
      
        }
        $output['data'][] = array(
          "SIZE"=>$fullcount,
         "ID"=>$row['ID'],
         "APPOINT_TYPE"=>$row['APPOINT_TYPE'],
         "CUS_APPOINT_ID"=>$row['CUS_APPOINT_ID'],
          "CARD_NO"=>$row['CARD_NO'],
          "CUS_ID"=>$row['CUS_ID'],
          "USER_ID"=> $userid,
          "SERVICE_CODE"=>$row['SERVICE_CODE'],
           "APPOINT_DATETIME"=>$row['APPOINT_DATETIME'],
           "APPOINT_DESCI"=>$row['APPOINT_DESCI'],
           "LEFT_TIME"=>$row['LEFT_TIME'],
            "PAYMENT_REQ"=>$row['PAYMENT_REQ'],
            "APPOINT_STATUS"=>$row['APPOINT_STATUS'],
            "OPTIONS"=>$process,
        );
      }
      return $output;
    }
    else{
      $output['data'][] = array(
        "OUTPUT"=>false
              );
              return $output;
    }
    }

    public function singleCusData($CUS_ID){
      $this->db->query('SELECT CUS_ID ,CUS_NAME,SEX,AGE,PHONENO,REG_DATE FROM `customer_detail` WHERE `CUS_ID` = :CUS_ID ');
    // Bind Values
    $this->db->bind(':CUS_ID', $CUS_ID);
      $row = $this->db->single();
      if($this->db->rowCount() > 0){
        return $row;
      } else {
        return false;
      }
  
    }

    public function get_age($CUS_ID){
      $this->db->query('SELECT AGE FROM `customer_detail` WHERE `CUS_ID` = :CUS_ID ');
    // Bind Values
    $this->db->bind(':CUS_ID', $CUS_ID);
      $row = $this->db->single();
      if($this->db->rowCount() > 0){
        return $row->AGE;
      } else {
        return false;
      }
  
    }

    public function singleUserData($USER_ID){
      $this->db->query('SELECT USER_ID ,FULL_NAME,SEX,PHONENO,MAJOR_ACTOR,PROFESSION FROM `user` WHERE `USER_ID` = :USER_ID ');
    // Bind Values
    $this->db->bind(':USER_ID', $USER_ID);
      $row = $this->db->single();
      if($this->db->rowCount() > 0){
        return $row;
      } else {
        return false;
      }
  
    }

    public function singlePayData($REQ_ID){
      $this->db->query('SELECT PAID_AMOUNT ,LEFT_AMOUNT,PAYMENT_TYPE FROM `pre_service_payments` WHERE `REQ_ID` = :REQ_ID ');
    // Bind Values
    $this->db->bind(':REQ_ID', $REQ_ID);
      $row = $this->db->single();
      if($this->db->rowCount() > 0){
        return $row;
      } else {
        return false;
      }
  
    }

    public function singleServiceData($SERVICE_CODE){
      $query="SELECT s.SERVICE_CODE,s.SERVICE_NAME,s.MAJOR_SER_CODE,s.PRICE,s.DESCI,m.SER_NAME FROM `ser_list` s INNER JOIN `ser_gen_catagory` m ON s.MAJOR_SER_CODE = m.MAJOR_SER_CODE WHERE  s.SERVICE_CODE ='".$SERVICE_CODE."'";
      $this->db->query($query);
    // Bind Values
   
      $row = $this->db->single();
      if($this->db->rowCount() > 0){
        return $row;
      } else {
        return false;
      }
  
    }

      public function getcusdata2($customername,$customerid){
        $flag=0;
   
      $query="SELECT m.CUS_NAME,m.CUS_ID,m.SEX,m.AGE,m.PHONENO,m.REGION,m.CITY,m.NATIONALITY,c.CARD_NO,c.DATE_CREATED,c.DURATION,c.EXPIRY_DATE FROM `customer_detail` m INNER JOIN `card` c ON c.CUS_ID = m.CUS_ID WHERE ";
        if($customername == null && $customerid == null ){
          $output['data'][] = array(
            "OUTPUT"=>false
                  );
                  return $output;
        }
        else{
          if($customername != null ){
            if($flag==0){
              $query.="m.CUS_NAME LIKE '".$customername."' ";
              $flag=1;
            }
            else{
              $query.="OR m.CUS_NAME LIKE '".$customername."' ";
            }
            
          }
          if($customerid != null ){
            if($flag==0)
            $query.="m.CUS_ID='"."CUS".$customerid."' ";
          else
          $query.="OR m.CUS_ID='"."CUS".$customerid."' ";
          }
         
        
       $this->db->query($query);
       
       $result = $this->db->resultsetASSO();
      $fullcount=$this->db->rowCount();
    
    
    if($result!=NULL){
      foreach ($result as $row ) {
        $workflow='<a   onclick="showFLOW(\''.$row['CARD_NO'].'\')" class="" style="list-style-type:none"> Show Data</a>';

        $output['data'][] = array(
          "SIZE"=>$fullcount,
         "CUS_NAME"=>$row['CUS_NAME'],
         "CUS_ID"=>$row['CUS_ID'],
          "SEX"=>$row['SEX'],
          "AGE"=>$row['AGE'],
          "PHONENO"=>$row['PHONENO'],
           "REGION"=>$row['REGION'],
           "CITY"=>$row['CITY'],
           "NATIONALITY"=>$row['NATIONALITY'],
            "CARD_NO"=>$row['CARD_NO'],
            "DATE_CREATED"=>$row['DATE_CREATED'],
            "DURATION"=>$row['DURATION'],
            "EXPIRY_DATE"=>$row['EXPIRY_DATE'],
            "WORKFLOW"=>$workflow,
        );
      }
      return $output;
    }
    else{
      $output['data'][] = array(
        "OUTPUT"=>false
              );
              return $output;
    }
        }

    }

    public function get_card_detail(){
      $this->db->query("SELECT `CARD_PR_TYPE`,`CARD_PR_DES`,`CARD_PR_PRICE`,`DURATION`,`PRIORITY` FROM `card_pr_type` where `CARD_PR_STATUS` ='EN' ");
      $result = $this->db->resultset();
      
    return $result;
    }

    public function get_card_detail2($CARD_PR_TYPE){
      $this->db->query("SELECT `CARD_PR_TYPE`,`CARD_PR_DES`,`CARD_PR_PRICE`,`DURATION`,`PRIORITY` FROM `card_pr_type` where `CARD_PR_TYPE`=:CARD_PR_TYPE ");
     
        $this->db->bind(':CARD_PR_TYPE', $CARD_PR_TYPE);
  
      $result = $this->db->single();
     
  return $result;
    }

    public function get_payment_info($REQ_ID,$table_id){
      $this->db->query("SELECT `REQ_PAYMENT_STATUS` FROM `".$table_id."` where `REQ_ID`=:REQ_ID ");
     
        $this->db->bind(':REQ_ID', $REQ_ID);
  
      $result = $this->db->single();
     
  return $result->REQ_PAYMENT_STATUS;
    }

    public function getpayment($date1,$date2,$PAY_TYPE,$PAY_STATUS,$CARD_ID,$CUS_ID,$CUSTOMER_NAME){
      $flag=0;
      $date1=$date1." 00:00:00";
      $date2=trim($date2." 23:59:59");
      if($CUSTOMER_NAME == null){
        $query="SELECT c.CUS_NAME,r.REQ_ID,r.REQ_TYPE,r.CUS_ID,r.CARD_NO,r.USER_ID,r.MAJOR_SER_CODE,r.SERVICE_CODE,r.REQ_DESCI,r.DATE_CREATED,r.REQ_STATUS,r.REQ_PAYMENT_STATUS,r.DONEBY,r.REQ_TAKE_TIME,r.REQ_DONE_TIME
        FROM `req_rcn` r INNER JOIN (SELECT `CUS_NAME`,`CUS_ID` FROM `customer_detail` WHERE `CARD_STATUS`='NE'  )
         c ON r.CUS_ID = c.CUS_ID WHERE r.DATE_CREATED BETWEEN '".$date1."' AND '".$date2."' 
         AND r.REQ_PAYMENT_STATUS ='".$PAY_STATUS."'  ";
        
        if($PAY_TYPE == 'CAR_T' || $PAY_TYPE == 'APPT_T'){
          $query.="AND r.MAJOR_SER_CODE = '".$PAY_TYPE."' ";
        }
       else{
        $query.=" AND r.MAJOR_SER_CODE <> 'CAR_T'";
       }
  
          if($CUS_ID != null ){
          $query.="AND r.CUS_ID='"."CUS".$CUS_ID."' ";
          }
  
          if($CARD_ID != null ){
            $query.="AND r.CARD_NO='"."CARD".$CARD_ID."' ";
            }
      }

        else{
          $query="SELECT c.CUS_NAME,r.REQ_ID,r.REQ_TYPE,r.CUS_ID,r.CARD_NO,r.USER_ID,r.MAJOR_SER_CODE,r.SERVICE_CODE,r.REQ_DESCI,r.DATE_CREATED,r.REQ_STATUS,r.REQ_PAYMENT_STATUS,r.DONEBY,r.REQ_TAKE_TIME,r.REQ_DONE_TIME
          FROM `req_rcn` r INNER JOIN (SELECT `CUS_NAME`,`CUS_ID` FROM `customer_detail` WHERE CUS_NAME LIKE '".$CUSTOMER_NAME."' )
           c ON r.CUS_ID = c.CUS_ID WHERE r.DATE_CREATED BETWEEN '".$date1."' AND '".$date2."' 
           AND r.REQ_PAYMENT_STATUS ='".$PAY_STATUS."'  ";
          
          if($PAY_TYPE == 'CAR_T' || $PAY_TYPE == 'APPT_T'){
            $query.=" AND r.MAJOR_SER_CODE = '".$PAY_TYPE."' ";
          }
         else{
          $query.=" AND r.MAJOR_SER_CODE <> 'CAR_T'";
         }
    
            if($CUS_ID != null ){
            $query.=" AND r.CUS_ID='"."CUS".$CUS_ID."' ";
            }
    
            if($CARD_ID != null ){
              $query.=" AND r.CARD_NO='"."CARD".$CARD_ID."' ";
              }

        }

     $this->db->query($query);
     
     $result = $this->db->resultsetASSO();
    $fullcount=$this->db->rowCount();
  
  
  if($result!=NULL){
    foreach ($result as $row ) {
      $SERVICE_PRICE=$this->singleServiceData($row['SERVICE_CODE']);
      $CUSTOMER_DETAIL='<a  data-toggle="modal" data-target="#showCusModal" onclick="get_user_data(\''.$row['CUS_ID'].'\')" class="" style="list-style-type:none"> '.$row['CUS_ID'].'</a>';
      $REQUESTER_DETAIL='<a  data-toggle="modal" data-target="#showUserModal" onclick="showUser(\''.$row['USER_ID'].'\')" class="" style="list-style-type:none">  '.$row['USER_ID'].'</a>';
      $SERVICE_DETAIL='<a   data-toggle="modal" data-target="#showSerModal" onclick="get_ser_data(\''.$row['SERVICE_CODE'].'\')" class="" style="list-style-type:none">  '.$row['SERVICE_CODE'].'</a>';
      $output['data'][] = array(
        "SIZE"=>$fullcount,
     "CUS_NAME"=>$row['CUS_NAME'],
     "REQ_ID"=>$row['REQ_ID'],
      "REQ_TYPE"=>$row['REQ_TYPE'],
      "CUS_ID"=>$CUSTOMER_DETAIL,
      "CARD_NO"=>$row['CARD_NO'],
       "USER_ID"=> $REQUESTER_DETAIL,
       "MAJOR_SER_CODE"=>$row['MAJOR_SER_CODE'],
       "SERVICE_CODE"=>$SERVICE_DETAIL,
       "SERVICE_PRICE"=>$SERVICE_PRICE->PRICE,
        "REQ_DESCI"=>$row['REQ_DESCI'],
        "DATE_CREATED"=>$row['DATE_CREATED'],
        "REQ_STATUS"=>$row['REQ_STATUS'],
        "REQ_PAYMENT_STATUS"=>$row['REQ_PAYMENT_STATUS'],
        "DONEBY"=>$row['DONEBY'],
        "REQ_TAKE_TIME"=>$row['REQ_TAKE_TIME'],
        "REQ_DONE_TIME"=>$row['REQ_DONE_TIME']
         
      );
    }
    return $output;
  }
  else{
    $output['data'][] = array(
      "OUTPUT"=>false
            );
            return $output;
  }
     

  }

  public function get_card_data($CARD_NO){
    $output = array('data' => array());
    $CARD_NO='CARD'.$CARD_NO;
    $this->db->query("SELECT `CARD_NO`,`CUS_ID`,`DATE_CREATED`,`EXPIRY_STATUS`,`CARD_TYPE` FROM `card` where  `CARD_NO`=:CARD_NO");
    $this->db->bind(':CARD_NO', $CARD_NO);
    $result = $this->db->resultsetASSO();
    $fullcount=$this->db->rowCount();
  $x=1;
  if($result!=null){
    foreach ($result as $row ) {
      $CUSTOMER_DETAIL='<a  data-toggle="modal" data-target="#showCusModal" onclick="get_user_data(\''.$row['CUS_ID'].'\')" class="" style="list-style-type:none"> '.$row['CUS_ID'].'</a>';
  
      $output['data'][] = array(
        "COUNTER"=>$x,
        "SIZE"=>$fullcount,
       "CARD_NO"=>$row['CARD_NO'],
       "CUS_ID"=>$CUSTOMER_DETAIL,
        "DATE_CREATED"=>$row['DATE_CREATED'],
        "EXPIRY_STATUS"=>$row['EXPIRY_STATUS'],
        "CARD_TYPE"=>$row['CARD_TYPE'],
        
      );
      $x++;
  
    }
    return $output;
  }
  else{
    $output['data'][] = array(
      "OUTPUT"=>false
            );
            return $output;
  }
 
  }

  public function get_gendet_result($CARD_NO){
    $this->db->query("SELECT `TEMPRATURE`,`PULSE_RATE`,`WEIGHT`,`HEIGHT`,`SYSTOLICBP`,`DIASTOLICBP` FROM `cus_rcn_genral_test` WHERE `CARD_NO`=:CARD_NO");
    $this->db->bind(':CARD_NO', $CARD_NO);
    $result=$this->db->single();
    if($fullcount=$this->db->rowCount()==0){
      return false;
    }
    else{
      return $result;
    }
  }

  public function get_gen_detail($date1,$date2,$REQ_STATUS,$CARD_ID,$CUS_ID,$CUSTOMER_NAME){
    $flag=0;
    $date1=$date1." 00:00:00";
    $date2=trim($date2." 23:59:59");
    if($CUSTOMER_NAME == null){
      $query="SELECT c.CUS_NAME,r.REQ_ID,r.REQ_TYPE,r.CUS_ID,r.CARD_NO,r.USER_ID,r.MAJOR_SER_CODE,r.SERVICE_CODE,r.REQ_DESCI,r.DATE_CREATED,r.REQ_STATUS,r.DONEBY,r.REQ_TAKE_TIME,r.REQ_DONE_TIME
      FROM `req_rcn` r INNER JOIN (SELECT `CUS_NAME`,`CUS_ID` FROM `customer_detail` WHERE `CARD_STATUS`='NE'  )
       c ON r.CUS_ID = c.CUS_ID WHERE r.DATE_CREATED BETWEEN '".$date1."' AND '".$date2."' 
       AND r.REQ_STATUS ='".$REQ_STATUS."' AND r.SERVICE_CODE='SR299' ";
      
    

        if($CUS_ID != null ){
        $query.="AND r.CUS_ID='"."CUS".$CUS_ID."' ";
        }

        if($CARD_ID != null ){
          $query.="AND r.CARD_NO='"."CARD".$CARD_ID."' ";
          }
    }

      else{
        $query="SELECT c.CUS_NAME,r.REQ_ID,r.REQ_TYPE,r.CUS_ID,r.CARD_NO,r.USER_ID,r.MAJOR_SER_CODE,r.SERVICE_CODE,r.REQ_DESCI,r.DATE_CREATED,r.REQ_STATUS,r.DONEBY,r.REQ_TAKE_TIME,r.REQ_DONE_TIME
        FROM `req_rcn` r INNER JOIN (SELECT `CUS_NAME`,`CUS_ID` FROM `customer_detail` WHERE CUS_NAME LIKE '".$CUSTOMER_NAME."' )
         c ON r.CUS_ID = c.CUS_ID WHERE r.DATE_CREATED BETWEEN '".$date1."' AND '".$date2."' 
         AND r.REQ_STATUS ='".$REQ_STATUS."' AND r.SERVICE_CODE='SR299'  ";
        
       
  
          if($CUS_ID != null ){
          $query.=" AND r.CUS_ID='"."CUS".$CUS_ID."' ";
          }
  
          if($CARD_ID != null ){
            $query.=" AND r.CARD_NO='"."CARD".$CARD_ID."' ";
            }

      }

   $this->db->query($query);
   
   $result = $this->db->resultsetASSO();
  $fullcount=$this->db->rowCount();


if($result!=NULL){
  foreach ($result as $row ) {
    $CUSTOMER_DETAIL='<a  data-toggle="modal" data-target="#showCusModal" onclick="get_user_data(\''.$row['CUS_ID'].'\')" class="" style="list-style-type:none"> '.$row['CUS_ID'].'</a>';
    $REQUESTER_DETAIL='<a  data-toggle="modal" data-target="#showUserModal" onclick="showUser(\''.$row['USER_ID'].'\')" class="" style="list-style-type:none">  '.$row['USER_ID'].'</a>';
    $SERVICE_DETAIL='<a   data-toggle="modal" data-target="#showSerModal" onclick="get_ser_data(\''.$row['SERVICE_CODE'].'\')" class="" style="list-style-type:none">  '.$row['SERVICE_CODE'].'</a>';
    $output['data'][] = array(
      "SIZE"=>$fullcount,
     "CUS_NAME"=>$row['CUS_NAME'],
     "REQ_ID"=>$row['REQ_ID'],
      "REQ_TYPE"=>$row['REQ_TYPE'],
      "CUS_ID"=>$CUSTOMER_DETAIL,
      "CARD_NO"=>$row['CARD_NO'],
       "USER_ID"=> $REQUESTER_DETAIL,
       "MAJOR_SER_CODE"=>$row['MAJOR_SER_CODE'],
       "SERVICE_CODE"=>$SERVICE_DETAIL,
       
        "REQ_DESCI"=>$row['REQ_DESCI'],
        "DATE_CREATED"=>$row['DATE_CREATED'],
        "REQ_STATUS"=>$row['REQ_STATUS'],
    
        "DONEBY"=>$row['DONEBY'],
        "REQ_TAKE_TIME"=>$row['REQ_TAKE_TIME'],
        "REQ_DONE_TIME"=>$row['REQ_DONE_TIME']
       
    );
  }
  return $output;
}
else{
  $output['data'][] = array(
    "OUTPUT"=>false
          );
          return $output;
}
   

}

public function get_requests($date1,$date2,$REQ_TYPE,$REQ_STATUS,$CARD_ID,$CUS_ID){
  $service_owner=$this->help->get_service_owner($REQ_TYPE);
  $flag=0;
  $date1=$date1." 00:00:00";
  $date2=trim($date2." 23:59:59");
  
    $query="SELECT r.REQ_ID,r.REQ_TYPE,r.CUS_ID,r.CARD_NO,r.USER_ID,r.MAJOR_SER_CODE,r.SERVICE_CODE,r.REQ_DESCI,r.DATE_CREATED,r.REQ_STATUS,r.DONEBY,r.REQ_TAKE_TIME,r.REQ_DONE_TIME
    FROM `".$service_owner->REQUEST."` r 
    WHERE r.DATE_CREATED BETWEEN '".$date1."' AND '".$date2."' 
     AND r.REQ_STATUS = '".$REQ_STATUS."' AND r.MAJOR_SER_CODE = '".$REQ_TYPE."' ";
      if($CUS_ID != null ){
      $query.="AND r.CUS_ID='"."CUS".$CUS_ID."' ";
      }

      if($CARD_ID != null ){
        $query.="AND r.CARD_NO='"."CARD".$CARD_ID."' ";
        }
 $this->db->query($query);
 
 $result = $this->db->resultsetASSO();
$fullcount=$this->db->rowCount();


if($result!=NULL){
foreach ($result as $row ) {
  $LINK=$this->help->generate_link($REQ_TYPE,$row['REQ_ID'],$row['CUS_ID'],$row['CARD_NO']);
  $PROCESS='<a   onclick="processdata(\''.$LINK.'\')" class="" style="list-style-type:none"> '.'PROCESS'.'</a>';
  $CUSTOMER_DETAIL='<a  data-toggle="modal" data-target="#showCusModal" onclick="get_user_data(\''.$row['CUS_ID'].'\')" class="" style="list-style-type:none"> '.$row['CUS_ID'].'</a>';
  $REQUESTER_DETAIL='<a  data-toggle="modal" data-target="#showUserModal" onclick="showUser(\''.$row['USER_ID'].'\')" class="" style="list-style-type:none">  '.$row['USER_ID'].'</a>';
  $SERVICE_DETAIL='<a   data-toggle="modal" data-target="#showSerModal" onclick="get_ser_data(\''.$row['SERVICE_CODE'].'\')" class="" style="list-style-type:none">  '.$row['SERVICE_CODE'].'</a>';
  $output['data'][] = array(
    "SIZE"=>$fullcount,
    "PROCESS"=> $PROCESS,
   "REQ_ID"=>$row['REQ_ID'],
    "REQ_TYPE"=>$row['REQ_TYPE'],
    "CUS_ID"=>$CUSTOMER_DETAIL,
    "CARD_NO"=>$row['CARD_NO'],
     "USER_ID"=> $REQUESTER_DETAIL,
     "MAJOR_SER_CODE"=>$row['MAJOR_SER_CODE'],
     "SERVICE_CODE"=>$SERVICE_DETAIL,
      "REQ_DESCI"=>$row['REQ_DESCI'],
      "DATE_CREATED"=>$row['DATE_CREATED'],
      "REQ_STATUS"=>$row['REQ_STATUS'],
      "DONEBY"=>$row['DONEBY'],
      "REQ_TAKE_TIME"=>$row['REQ_TAKE_TIME'],
      "REQ_DONE_TIME"=>$row['REQ_DONE_TIME']
     
  );
}
return $output;
}
else{
$output['data'][] = array(
  "OUTPUT"=>false
        );
        return $output;
}
 

}

public function get_notifications($date1,$date2,$REQ_TYPE,$NOTI_STATUS){
  $service_owner=$this->help->get_service_owner($REQ_TYPE);
  $flag=0;
  $date1=$date1." 00:00:00";
  $date2=trim($date2." 23:59:59");
  
    $query="SELECT r.REQ_ID,r.CUS_ID,r.CARD_NO,r.USER_ID,r.MAJOR_SER_CODE,r.SERVICE_CODE,r.HEADER,r.DATE_CREATE,r.DESCI,r.NOTI_STATUS
    FROM `".$service_owner->NOTIFICATION."` r 
    WHERE r.DATE_CREATE BETWEEN '".$date1."' AND '".$date2."' 
     AND r.NOTI_STATUS = '".$NOTI_STATUS."' AND r.MAJOR_SER_CODE = '".$REQ_TYPE."' ";
    
 $this->db->query($query);
 
 $result = $this->db->resultsetASSO();
$fullcount=$this->db->rowCount();


if($result!=NULL){
foreach ($result as $row ) {
  $CUSTOMER_DETAIL='<a  data-toggle="modal" data-target="#showCusModal" onclick="get_user_data(\''.$row['CUS_ID'].'\')" class="" style="list-style-type:none"> '.$row['CUS_ID'].'</a>';
  $REQUESTER_DETAIL='<a  data-toggle="modal" data-target="#showUserModal" onclick="showUser(\''.$row['USER_ID'].'\')" class="" style="list-style-type:none">  '.$row['USER_ID'].'</a>';
  $SERVICE_DETAIL='<a   data-toggle="modal" data-target="#showSerModal" onclick="get_ser_data(\''.$row['SERVICE_CODE'].'\')" class="" style="list-style-type:none">  '.$row['SERVICE_CODE'].'</a>';
  $output['data'][] = array(
    "SIZE"=>$fullcount,
  
   "REQ_ID"=>$row['REQ_ID'],
    "CUS_ID"=>$CUSTOMER_DETAIL,
    "CARD_NO"=>$row['CARD_NO'],
     "USER_ID"=> $REQUESTER_DETAIL,
     "MAJOR_SER_CODE"=>$row['MAJOR_SER_CODE'],
     "SERVICE_CODE"=>$SERVICE_DETAIL,
      "HEADER"=>$row['HEADER'],
      "DATE_CREATE"=>$row['DATE_CREATE'],
      "DESCI"=>$row['DESCI'],
      "NOTI_STATUS"=>$row['NOTI_STATUS'],

  );
}
return $output;
}
else{
$output['data'][] = array(
  "OUTPUT"=>false
        );
        return $output;
}
 

}

      public function check_card_avai($CUS_ID){
        $query="SELECT CUS_ID FROM `card` WHERE `CUS_ID` = :CUS_ID";
        $this->db->query($query);
      
        $this->db->bind(':CUS_ID', $CUS_ID);
        $row = $this->db->resultsetASSO();
        if($this->db->rowCount() > 0){
          return $row;
        } else {
          return false;
        }
      }
      
      public function get_sin_req($reqtable,$REQ_ID){
        $this->db->query("SELECT `SERVICE_CODE` FROM `".$reqtable."` WHERE `REQ_ID`=:REQ_ID ;");
        $this->db->bind(':REQ_ID', $REQ_ID);
      $single_req = $this->db->single();

      return $single_req;

      }

      public function addcustomer($data){
            $data['CUS_ID'].=$this->help->get_last_id('customer_detail');
            $noti_detail=$this->help->get_noti_detail('SR458');
            $major_ser_code=$this->help->getMajor_ser_code('SR458');
            $service_owner=$this->help->get_service_owner($major_ser_code);
            $req_id=strtoupper($service_owner->TAG).$this->help->get_last_id($service_owner->REQUEST);
            $user_info=$this->singleUserData($_SESSION['user_id']);
        // Prepare Query 
    $this->db->query('INSERT INTO `customer_detail`(`CUS_ID`, `USER_ID`, `CUS_NAME`, `SEX`, `AGE`, `PHONENO`, `REGION`, `CITY`, `NATIONALITY`) 
    VALUES (:CUS_ID,:USER_ID,:CUS_NAME,:SEX,:AGE,:PHONENO,:REGION,:CITY,:NATIONALITY)');
    
    // Bind Values
    $this->db->bind(':CUS_ID', $data['CUS_ID']);
    $this->db->bind(':USER_ID', $data['USER_ID']);
    $this->db->bind(':CUS_NAME', $data['CUS_NAME']);
    $this->db->bind(':SEX', $data['SEX']);
    $this->db->bind(':AGE', $data['AGE']);
    $this->db->bind(':PHONENO', $data['PHONENO']);
    $this->db->bind(':REGION', $data['REGION']);
    $this->db->bind(':CITY', $data['CITY']);
    $this->db->bind(':NATIONALITY', $data['NATIONALITY']);
    if($this->db->execute()){
        $requestdata=[
          "TABLE_ID"=>$service_owner->REQUEST,
          "REQ_ID"=>$req_id,
          "REQ_TYPE"=>"REGULAR",
        "CUS_ID"=> $data['CUS_ID'],
        "CARD_NO"=>"",
        "USER_ID"=>$_SESSION['user_id'],
        "MAJOR_SER_CODE"=> $major_ser_code,
        "SERVICE_CODE"=>"SR458",
        "REQ_DESCI"=>strtoupper('new card request for a new customer'),
        "REQ_STATUS"=>'P',
        "REQ_PAYMENT_STATUS"=>"TNP",
        "DONEBY"=>"",
        "REQ_TAKE_TIME"=>'',
        "REQ_DONE_TIME"=>''
      ];
        if($this->add_req_rcn($requestdata))
        {
          $notidata=[ 
            "TABLE_ID"=>$service_owner->NOTIFICATION,
            "USER_ID"=>$_SESSION['user_id'],
            "MAJOR_SER_CODE"=>$major_ser_code,
            "SERVICE_CODE"=>"SR458",
            "CUS_ID"=>$data['CUS_ID'],
            "CARD_NO"=>"",
            "REQ_ID"=>$req_id,
            "HEADER"=>$noti_detail->HEADER,
            "DESCI"=>$noti_detail->DESCI];
            if($this->add_noti_rcn($notidata))
            {    
              $workflow_data=[ 
                "REQ_ID"=>$req_id,
                "REQ_CODE"=>"SR458",
                "CARD_NO"=>"",
                "CUS_ID"=>$data['CUS_ID'],
                "FLOW_FROM"=> $user_info->MAJOR_ACTOR,
                "FLOW_SENDER"=>$_SESSION['user_id'],
                "FLOW_TO"=>"",
                "FLOW_DESCI"=>""];
                if($this->add_workflow($workflow_data))
            {
                   $queue_data=[ 
                    "TABLE_ID"=>$service_owner->QUEUE,
                "REQ_ID"=>$req_id,
                "REQ_TYPE"=>"REGULAR",
                "CUS_ID"=>$data['CUS_ID'],
                "CARD_NO"=>"",
                "MAJOR_SER_CODE"=>$major_ser_code,
                "SERVICE_CODE"=> "SR458",
                "CARDTYPE"=>"",
                "DATE_CREATED"=>date("Y-m-d h:m:s"),
                "CUS_NAME"=>$data['CUS_NAME'],
                "FORWARD_FROM"=>$_SESSION['user_id'],
                "STATUS"=>"P",
                "QUEUE_CLOSED_TIME"=>""];
                if($this->add_queue($queue_data))
                return true;
                else
                return false;
           
            }else{
                return false;
            }
                
            }
            else{
              return false;
            }
        }
        else{
          return false;
        }
     
    } else {
     return false;
    }
    }

    public function addpaymentdata($data){
      $data['CUS_ID'].=$this->help->get_last_id('customer_detail');
      $CARDNO='CARD'.$this->help->get_last_id('card');
      $card_detail=$this->get_card_detail2($data['CARD_TYPE']);
      $noti_detail=$this->help->get_noti_detail($data['SERVICE_CODE']);
      $major_ser_code=$this->help->getMajor_ser_code($data['SERVICE_CODE']);
      $service_owner=$this->help->get_service_owner($major_ser_code);
      $req_id=strtoupper('rcn').$this->help->get_last_id('req_rcn');
      $user_info=$this->singleUserData($_SESSION['user_id']);
      $expiry=date_create(date('Y-m-d h:m:s'));
      date_add($expiry, date_interval_create_from_date_string($card_detail->DURATION.' days'));
      $expiry= date_format($expiry, 'Y-m-d h:m:s');
  // Prepare Query 
$this->db->query('INSERT INTO `customer_detail`(`CUS_ID`, `USER_ID`, `CUS_NAME`, `SEX`, `AGE`, `PHONENO`, `REGION`, `CITY`, `NATIONALITY`) 
VALUES (:CUS_ID,:USER_ID,:CUS_NAME,:SEX,:AGE,:PHONENO,:REGION,:CITY,:NATIONALITY)');

// Bind Values
$this->db->bind(':CUS_ID', $data['CUS_ID']);
$this->db->bind(':USER_ID', $data['USER_ID']);
$this->db->bind(':CUS_NAME', $data['CUS_NAME']);
$this->db->bind(':SEX', $data['SEX']);
$this->db->bind(':AGE', $data['AGE']);
$this->db->bind(':PHONENO', $data['PHONENO']);
$this->db->bind(':REGION', $data['REGION']);
$this->db->bind(':CITY', $data['CITY']);
$this->db->bind(':NATIONALITY', $data['NATIONALITY']);
if($this->db->execute()){
 
  $carddata=[ 
    "CARD_NO"=>$CARDNO,
    "CUS_ID"=>$data['CUS_ID'],
    "USER_ID"=>$_SESSION['user_id'],
    "DATE_CREATED"=>date('Y-m-d h:m:s'),
    "DURATION"=>$card_detail->DURATION,
    "EXPIRY_DATE"=>$expiry,
    "CARD_TYPE"=>$card_detail->CARD_PR_DES,
    "CARD_PR_TYPE"=>$card_detail->PRIORITY,
    ]; 
    if($this->add_card($carddata))
    {
      $requestdata=[
        "TABLE_ID"=>'req_rcn',
        "REQ_ID"=>$req_id,
        "REQ_TYPE"=>$card_detail->CARD_PR_DES,
      "CUS_ID"=> $data['CUS_ID'],
      "CARD_NO"=>$CARDNO,
      "USER_ID"=>$_SESSION['user_id'],
      "MAJOR_SER_CODE"=> $major_ser_code,
      "SERVICE_CODE"=>$data['SERVICE_CODE'],
      "REQ_DESCI"=> $noti_detail->DESCI,
      "REQ_STATUS"=>'P',
      "REQ_PAYMENT_STATUS"=>"TNP",
      "DONEBY"=>"",
      "REQ_TAKE_TIME"=>'',
      "REQ_DONE_TIME"=>''
    ];
      if($this->add_req_rcn($requestdata))
      {
        $notidata=[ 
          "TABLE_ID"=>'noti_rcn',
          "USER_ID"=>$_SESSION['user_id'],
          "MAJOR_SER_CODE"=>$major_ser_code,
          "SERVICE_CODE"=>$data['SERVICE_CODE'],
          "CUS_ID"=>$data['CUS_ID'],
          "CARD_NO"=>$CARDNO,
          "REQ_ID"=>$req_id,
          "HEADER"=>$noti_detail->HEADER,
          "DESCI"=>$noti_detail->DESCI];
          if($this->add_noti_rcn($notidata))
          {    
            $workflow_data=[ 
              "REQ_ID"=>$req_id,
              "REQ_CODE"=>$data['SERVICE_CODE'],
              "CARD_NO"=>$CARDNO,
              "CUS_ID"=>$data['CUS_ID'],
              "FLOW_FROM"=> $user_info->MAJOR_ACTOR,
              "FLOW_SENDER"=>$_SESSION['user_id'],
              "FLOW_TO"=>"",
              "FLOW_DESCI"=>""];
              if($this->add_workflow($workflow_data))
          {
                 $queue_data=[ 
                  "TABLE_ID"=>$service_owner->QUEUE,
              "REQ_ID"=>$req_id,
              "REQ_TYPE"=>$card_detail->CARD_PR_DES,
              "CUS_ID"=>$data['CUS_ID'],
              "CARD_NO"=>$CARDNO,
              "MAJOR_SER_CODE"=>$major_ser_code,
              "SERVICE_CODE"=> $data['SERVICE_CODE'],
              "CARDTYPE"=>"",
              "DATE_CREATED"=>date("Y-m-d h:m:s"),
              "CUS_NAME"=>$data['CUS_NAME'],
              "FORWARD_FROM"=>$_SESSION['user_id'],
              "STATUS"=>"P",
              "QUEUE_CLOSED_TIME"=>""];
              if($this->add_queue($queue_data))
              return true;
              else
              return false;
         
          }else{
              return false;
          }
              
          }
          else{
            return false;
          }
      }
      else{
        return false;
      }
    }
  else{
    return false;
  }

} else {
return false;
}
}

public function add_gen($data){
 
  // Prepare Query 
$this->db->query("INSERT INTO `cus_rcn_genral_test`(`CARD_NO`,`CUS_ID`, `CUS_NAME`, `USER_ID`, `AGE`, `TEMPRATURE`, `PULSE_RATE`, `WEIGHT`,`HEIGHT`,`SYSTOLICBP`,`DIASTOLICBP`) 
                                      
VALUES (:CARD_NO,:CUS_ID,:CUS_NAME,:USER_ID,:AGE,:TEMPRATURE,:PULSE_RATE,:WEIGHT,:HEIGHT,:SYSTOLICBP,:DIASTOLICBP)");

// Bind Values
$this->db->bind(':CARD_NO', $data['CARD_NO']);
$this->db->bind(':CUS_ID', $data['CUS_ID']);
$this->db->bind(':CUS_NAME', $data['CUS_NAME']);
$this->db->bind(':USER_ID', $data['USER_ID']);
$this->db->bind(':AGE', $data['AGE']);
$this->db->bind(':TEMPRATURE', $data['TEMPRATURE']);
$this->db->bind(':PULSE_RATE', $data['PULSE_RATE']);
$this->db->bind(':WEIGHT', $data['WEIGHT']);
$this->db->bind(':HEIGHT', $data['HEIGHT']);
$this->db->bind(':SYSTOLICBP', $data['SYSTOLICBP']);
$this->db->bind(':DIASTOLICBP', $data['DIASTOLICBP']);

if($this->db->execute()){
return true;
} else {
return false;
}
}


    public function add_req_rcn($data){
 
      // Prepare Query 
  $this->db->query("INSERT INTO `".$data['TABLE_ID']."`(`REQ_ID`,`REQ_TYPE`, `CUS_ID`, `CARD_NO`, `USER_ID`, `MAJOR_SER_CODE`, `SERVICE_CODE`, `REQ_DESCI`,`REQ_STATUS`,`REQ_PAYMENT_STATUS`,`DONEBY`,`REQ_TAKE_TIME`,`REQ_DONE_TIME`) 
                                          
  VALUES (:REQ_ID,:REQ_TYPE,:CUS_ID,:CARD_NO,:USER_ID,:MAJOR_SER_CODE,:SERVICE_CODE,:REQ_DESCI,:REQ_STATUS,:REQ_PAYMENT_STATUS,:DONEBY,:REQ_TAKE_TIME,:REQ_DONE_TIME)");
  
  // Bind Values
  $this->db->bind(':REQ_ID', $data['REQ_ID']);
  $this->db->bind(':REQ_TYPE', $data['REQ_TYPE']);
  $this->db->bind(':CUS_ID', $data['CUS_ID']);
  $this->db->bind(':CARD_NO', $data['CARD_NO']);
  $this->db->bind(':USER_ID', $data['USER_ID']);
  $this->db->bind(':MAJOR_SER_CODE', $data['MAJOR_SER_CODE']);
  $this->db->bind(':SERVICE_CODE', $data['SERVICE_CODE']);
  $this->db->bind(':REQ_DESCI', $data['REQ_DESCI']);
  $this->db->bind(':REQ_STATUS', $data['REQ_STATUS']);
  $this->db->bind(':REQ_PAYMENT_STATUS', $data['REQ_PAYMENT_STATUS']);
  $this->db->bind(':DONEBY', $data['DONEBY']);
  $this->db->bind(':REQ_TAKE_TIME', $data['REQ_TAKE_TIME']);
  $this->db->bind(':REQ_DONE_TIME', $data['REQ_DONE_TIME']);
 
  if($this->db->execute()){
   return true;
  } else {
   return false;
  }
  }

  public function add_noti_rcn($data){
 
    // Prepare Query 
      $this->db->query("INSERT INTO `".$data['TABLE_ID']."`(`USER_ID`, `MAJOR_SER_CODE`, `SERVICE_CODE`, `CUS_ID`, `CARD_NO`, `REQ_ID`,`HEADER`, `DESCI`) 
                                              
      VALUES (:USER_ID,:MAJOR_SER_CODE,:SERVICE_CODE,:CUS_ID,:CARD_NO,:REQ_ID,:HEADER,:DESCI)");

      // Bind Values
      $this->db->bind(':USER_ID', $data['USER_ID']);
      $this->db->bind(':MAJOR_SER_CODE', $data['MAJOR_SER_CODE']);
      $this->db->bind(':SERVICE_CODE', $data['SERVICE_CODE']);
      $this->db->bind(':CUS_ID', $data['CUS_ID']);
      $this->db->bind(':CARD_NO', $data['CARD_NO']);
      $this->db->bind(':REQ_ID', $data['REQ_ID']);
      $this->db->bind(':HEADER', $data['HEADER']);
      $this->db->bind(':DESCI', $data['DESCI']);
      if($this->db->execute()){
      return true;
      } else {
      return false;
      }
      }

    public function add_workflow($data){
    
      // Prepare Query 
    $this->db->query('INSERT INTO `cus_workflow`(`REQ_ID`, `REQ_CODE`,  `CARD_NO`, `CUS_ID`,  `FLOW_FROM`, `FLOW_SENDER`, `FLOW_TO`, `FLOW_DESCI`) 
                                          
    VALUES (:REQ_ID,:REQ_CODE,:CARD_NO,:CUS_ID,:FLOW_FROM,:FLOW_SENDER,:FLOW_TO,:FLOW_DESCI)');


    // Bind Values
    $this->db->bind(':REQ_ID', $data['REQ_ID']);
    $this->db->bind(':REQ_CODE', $data['REQ_CODE']);
    $this->db->bind(':CARD_NO', $data['CARD_NO']);
    $this->db->bind(':CUS_ID', $data['CUS_ID']);
    $this->db->bind(':FLOW_FROM', $data['FLOW_FROM']);
    $this->db->bind(':FLOW_SENDER', $data['FLOW_SENDER']);
    $this->db->bind(':FLOW_TO', $data['FLOW_TO']);
    $this->db->bind(':FLOW_DESCI', $data['FLOW_DESCI']);
    if($this->db->execute()){
    return true;
    } else {
    return false;
    }
    }

    
    public function add_queue($data){
    
      // Prepare Query 
    $this->db->query("INSERT INTO `".$data['TABLE_ID']."`(`REQ_ID`,`REQ_TYPE`, `CUS_ID`, `CARD_NO`, 
    `MAJOR_SER_CODE`, `SERVICE_CODE`, `CARDTYPE`,
     `CUS_NAME`, `DATE_CREATED`, `FORWARD_FROM`, `STATUS`, `QUEUE_CLOSED_TIME`) 
                                          
    VALUES (:REQ_ID,:REQ_TYPE,:CUS_ID,:CARD_NO,:MAJOR_SER_CODE,:SERVICE_CODE,:CARDTYPE,:CUS_NAME,:DATE_CREATED,:FORWARD_FROM,:STATUS,:QUEUE_CLOSED_TIME)");


    // Bind Values
    $this->db->bind(':REQ_ID', $data['REQ_ID']);
    $this->db->bind(':REQ_TYPE', $data['REQ_TYPE']);
    $this->db->bind(':CUS_ID', $data['CUS_ID']);
    $this->db->bind(':CARD_NO', $data['CARD_NO']);
    $this->db->bind(':MAJOR_SER_CODE', $data['MAJOR_SER_CODE']);
    $this->db->bind(':SERVICE_CODE', $data['SERVICE_CODE']);
    $this->db->bind(':CARDTYPE', $data['CARDTYPE']);
    $this->db->bind(':CUS_NAME', $data['CUS_NAME']);
    $this->db->bind(':DATE_CREATED', $data['DATE_CREATED']);
    $this->db->bind(':FORWARD_FROM', $data['FORWARD_FROM']);
    $this->db->bind(':STATUS', $data['STATUS']);
    $this->db->bind(':QUEUE_CLOSED_TIME', $data['QUEUE_CLOSED_TIME']);
    
    if($this->db->execute()){
    return true;
    } else {
    return false;
    }
    }

    public function add_card($data){
    
      $this->db->query('INSERT INTO `card`(`CARD_NO`, `CUS_ID`, `USER_ID`, `DATE_CREATED`, `DURATION`, `EXPIRY_DATE`, `CARD_TYPE`, `CARD_PR_TYPE`) 
      VALUES (:CARD_NO,:CUS_ID,:USER_ID,:DATE_CREATED,:DURATION,:EXPIRY_DATE,:CARD_TYPE,:CARD_PR_TYPE)');
      
      // Bind Values
      $this->db->bind(':CARD_NO', $data['CARD_NO']);
      $this->db->bind(':CUS_ID', $data['CUS_ID']);
      $this->db->bind(':USER_ID', $data['USER_ID']);
      $this->db->bind(':DATE_CREATED', $data['DATE_CREATED']);
      $this->db->bind(':DURATION', $data['DURATION']);
      $this->db->bind(':EXPIRY_DATE',$data['EXPIRY_DATE']);
      
      $this->db->bind(':CARD_TYPE', $data['CARD_TYPE']);
      
      $this->db->bind(':CARD_PR_TYPE', $data['CARD_PR_TYPE']);
    
    if($this->db->execute()){
    return true;
    } else {
    return false;
    }
    }
    public function resend($CUS_ID,$CUS_NAME){
   
        $noti_detail=$this->help->get_noti_detail('SR458');
        $major_ser_code=$this->help->getMajor_ser_code('SR458');
        $service_owner=$this->help->get_service_owner($major_ser_code);
        $req_id=strtoupper($service_owner->TAG).$this->help->get_last_id($service_owner->REQUEST);
        $user_info=$this->singleUserData($_SESSION['user_id']);
        $requestdata=[
          "TABLE_ID"=>$service_owner->REQUEST,
          "REQ_ID"=>$req_id,
          "REQ_TYPE"=>"REGULAR",
        "CUS_ID"=> $CUS_ID,
        "CARD_NO"=>"",
        "USER_ID"=>$_SESSION['user_id'],
        "MAJOR_SER_CODE"=> $major_ser_code,
        "SERVICE_CODE"=>"SR458",
        "REQ_DESCI"=>strtoupper('new card request for a customer'),
        "REQ_STATUS"=>'P',
        "REQ_PAYMENT_STATUS"=>"TNP",
        "DONEBY"=>"",
        "REQ_TAKE_TIME"=>'',
        "REQ_DONE_TIME"=>'',
      ];

        if($this->add_req_rcn($requestdata))
        {
          $notidata=[ 
            "TABLE_ID"=>$service_owner->NOTIFICATION,
            "USER_ID"=>$_SESSION['user_id'],
            "MAJOR_SER_CODE"=>$major_ser_code,
            "SERVICE_CODE"=>"SR458",
            "CUS_ID"=>$CUS_ID,
            "CARD_NO"=>"",
            "REQ_ID"=>$req_id,
            "HEADER"=>$noti_detail->HEADER,
            "DESCI"=>$noti_detail->DESCI];
            if($this->add_noti_rcn($notidata))
            {    
              $workflow_data=[ 
                "REQ_ID"=>$req_id,
                "REQ_CODE"=>"SR458",
                "CARD_NO"=>"",
                "CUS_ID"=>$CUS_ID,
                "FLOW_FROM"=> $user_info->MAJOR_ACTOR,
                "FLOW_SENDER"=>$_SESSION['user_id'],
                "FLOW_TO"=>"",
                "FLOW_DESCI"=>""];
                if($this->add_workflow($workflow_data))
            {
              $queue_data=[ 
                "TABLE_ID"=>$service_owner->QUEUE,
            "REQ_ID"=>$req_id,
            "REQ_TYPE"=>"REGULAR",
            "CUS_ID"=>"SR458",
            "CARD_NO"=>"",
            "MAJOR_SER_CODE"=>$major_ser_code,
            "SERVICE_CODE"=>"SR458",
            "CARDTYPE"=>"",
            "DATE_CREATED"=>date("Y-m-d h:m:s"),
            "CUS_NAME"=>$CUS_NAME,
            "FORWARD_FROM"=>$_SESSION['user_id'],
            "STATUS"=>"",
            "QUEUE_CLOSED_TIME"=>""];
            if($this->add_queue($queue_data))
            return true;
            else
            return false;
            }else{
                return false;
            }
                
            }
            else{
              return false;
            }
        }
        else{
          return false;
        }
     
   
    }

    public function get_single_cusdata($CUS_ID){
               $query="SELECT * FROM `customer_detail` WHERE `CUS_ID` =:CUS_ID";
               $this->db->bind(':CUS_ID', $CUS_ID);
     $this->db->query($query);
     $result = $this->db->singleASSO();
  
  if($result!=NULL){
      return $output;
  }
  }

      public function getCardData($CUS_ID){
        
        $query="SELECT * FROM `card` WHERE `CUS_ID` = :CUS_ID ";
        $this->db->query($query);
      
        $this->db->bind(':CUS_ID', $CUS_ID);
        $result = $this->db->resultsetASSO();
    $fullcount=$this->db->rowCount();
      foreach ($result as $row ) {

        $output['data'][] = array(
          "SIZE"=>$fullcount,
         "ID"=>$row['ID'],
         "CARD_NO"=>$row['CARD_NO'],
         "CUS_ID"=>$row['CUS_ID'],
          "DATE_CREATED"=>$row['DATE_CREATED'],
          "DURATION"=>$row['DURATION'],
          "RENEW_DATE"=>$row['RENEW_DATE'],
          "EXPIRY_DATE"=>$row['EXPIRY_DATE'],
           "EXPIRY_STATUS"=>$row['EXPIRY_STATUS'],
           "CARD_TYPE"=>$row['CARD_TYPE'],
           "CARD_PR_TYPE"=>$row['CARD_PR_TYPE'],
         
        );

      }
      return $output;

      }

      public function getFlowData($CARD_NO){
        
        $query="SELECT * FROM `cus_workflow` WHERE `CARD_NO` = :CARD_NO";
        $this->db->query($query);
      
        $this->db->bind(':CARD_NO', $CARD_NO);
        $result = $this->db->resultsetASSO();
    $fullcount=$this->db->rowCount();
      foreach ($result as $row ) {

        $output['data'][] = array(
          "SIZE"=>$fullcount,
         "REQ_ID"=>$row['REQ_ID'],
         "REQ_CODE"=>$row['REQ_CODE'],
         "CARD_NO"=>$row['CARD_NO'],
          "CUS_ID"=>$row['CUS_ID'],
          "REQ_STATUS"=>$row['REQ_STATUS'],
          "DATE_CREATED"=>$row['DATE_CREATED'],
          "DATE_MODIFIED"=>$row['DATE_MODIFIED'],
           "FLOW_FROM"=>$row['FLOW_FROM'],
           "FLOW_SENDER"=>$row['FLOW_SENDER'],
           "FLOW_TO"=>$row['FLOW_TO'],
           "FLOW_RECEIVER"=>$row['FLOW_RECEIVER'],
                   
        );

      }
      return $output;

      }

      public function pro_card_payment($data){
        $CARDNO='CARD'.$this->help->get_last_id('card');
        
        $card_detail=$this->get_card_detail2($data['CARD_TYPE']);
        
        $service_owner=$this->help->get_service_owner($data['MAJOR_SER_CODE']);
        $expiry=date_create(date('Y-m-d h:m:s'));
        date_add($expiry, date_interval_create_from_date_string($card_detail->DURATION.' days'));
        $expiry= date_format($expiry, 'Y-m-d h:m:s');
    // Prepare Query
    $carddata=[ 
      "CARD_NO"=>$CARDNO,
      "CUS_ID"=>$data['CUS_ID'],
      "USER_ID"=>$_SESSION['user_id'],
      "DATE_CREATED"=>date('Y-m-d h:m:s'),
      "DURATION"=>$card_detail->DURATION,
      "EXPIRY_DATE"=>$expiry,
      "CARD_TYPE"=>$card_detail->CARD_PR_DES,
      "CARD_PR_TYPE"=>$card_detail->PRIORITY,
      ]; 
   

if($this->add_card($carddata)){
$req_service=$this->get_sin_req($service_owner->REQUEST,$data['REQ_ID']);
  $paymentdata=[ 
    "CARD_NO"=>$CARDNO,
    "REQ_ID"=>$data['REQ_ID'],
    "CUS_ID"=>$data['CUS_ID'],
    "USER_ID"=>$_SESSION['user_id'],
    "PAID_AMOUNT"=>$card_detail->CARD_PR_PRICE,
    "LEFT_AMOUNT"=>0,
    "PAYMENT_AMOUNT"=>$card_detail->CARD_PR_PRICE,
    "PAYMENT_STATUS"=>"C",
    "PAYMENT_TYPE"=>"PRE",
    "SERVICE_CODE"=>$req_service->SERVICE_CODE,
    ];
if($this->add_payment($paymentdata)){
  if($this->update_queue_status($data['REQ_ID'],$service_owner->QUEUE,"C",date("Y-m-d h:m:s"))){
    if($this->update_workflow_status($data['REQ_ID'],"C",date("Y-m-d h:m:s"))){
     if($this->update_req_status($data['REQ_ID'],$service_owner->REQUEST,"C","",date("Y-m-d h:m:s"),"TP")){
         
      $noti_detail=$this->help->get_noti_detail('SR299');
      $major_ser_code=$this->help->getMajor_ser_code('SR299');
      $service_owner=$this->help->get_service_owner($major_ser_code);
      $req_id=strtoupper($service_owner->TAG).$this->help->get_last_id($service_owner->REQUEST);
      $user_info=$this->singleUserData($_SESSION['user_id']);
      $requestdata=[
      "TABLE_ID"=>$service_owner->REQUEST,
      "REQ_ID"=>$req_id,
      "CUS_ID"=> $data['CUS_ID'],
      "CARD_NO"=>$CARDNO,
      "USER_ID"=>$_SESSION['user_id'],
      "MAJOR_SER_CODE"=> $major_ser_code,
      "SERVICE_CODE"=>"SR299",
      "REQ_DESCI"=>strtoupper($noti_detail->DESCI),
      "REQ_STATUS"=>'P',
      "REQ_PAYMENT_STATUS"=>"F",
      "DONEBY"=>"",
      "REQ_TAKE_TIME"=>'',
      "REQ_DONE_TIME"=>'',
      "REQ_TYPE"=>$card_detail->CARD_PR_DES
    ];

      if($this->add_req_rcn($requestdata))
      {
        $notidata=[ 
          "TABLE_ID"=>$service_owner->NOTIFICATION,
          "USER_ID"=>$_SESSION['user_id'],
          "MAJOR_SER_CODE"=>$major_ser_code,
          "SERVICE_CODE"=>"SR299",
          "CUS_ID"=>$data['CUS_ID'],
          "CARD_NO"=>$CARDNO,
          "REQ_ID"=>$req_id,
          "HEADER"=>$noti_detail->HEADER,
          "DESCI"=>$noti_detail->DESCI];
          if($this->add_noti_rcn($notidata))
          {    
            $workflow_data=[ 
              "REQ_ID"=>$req_id,
              "REQ_CODE"=>"SR299",
              "CARD_NO"=>$CARDNO,
              "CUS_ID"=>$data['CUS_ID'],
              "FLOW_FROM"=> $user_info->MAJOR_ACTOR,
              "FLOW_SENDER"=>$_SESSION['user_id'],
              "FLOW_TO"=>"",
              "FLOW_DESCI"=>""];
              if($this->add_workflow($workflow_data))
          {
            $queue_data=[ 
              "TABLE_ID"=>$service_owner->QUEUE,
          "REQ_ID"=>$req_id,
          "CUS_ID"=>$data['CUS_ID'],
          "CARD_NO"=>$CARDNO,
          "MAJOR_SER_CODE"=>$major_ser_code,
          "SERVICE_CODE"=>"SR299",
          "CARDTYPE"=>"",
          "DATE_CREATED"=>date("Y-m-d h:m:s"),
          "CUS_NAME"=>$data['CUS_NAME'],
          "FORWARD_FROM"=>$_SESSION['user_id'],
          "STATUS"=>"P",
          "QUEUE_CLOSED_TIME"=>"",
          "REQ_TYPE"=>$card_detail->CARD_PR_DES];
          if($this->add_queue($queue_data))
          return true;
          else
          return false;
          }else{
              return false;
          }
              
          }
          else{
            return false;
          }
      }
      else{
        return false;
      }

     }
     else{
       return false;
     }
    }
    else{
      return false;
    }
  }
  else{
    return false;
  }
}
else{
  return false;
}
  
 
} else {
 return false;
}
}
        public function pro_req_payment($data){
          $req_service=$this->get_sin_req('req_rcn',$data['REQ_ID']);
          $LEFT_AMOUNT;
          $PAYMENT_STATUS="";
          $WORKFLOW_STATUS="";
          $REQUEST_STATUS="";
          $PAYMENT_TYPE="";
          $TP='';
          $service_owner=$this->help->get_service_owner($data['MAJOR_SER_CODE']);
        $paymentinfo=$this->singlePayData($data['REQ_ID']);
        if($paymentinfo!=false){
            $LEFT_AMOUNT=$paymentinfo->LEFT_AMOUNT-$data['PAID_AMOUNT'];
            if($LEFT_AMOUNT==0){
              $PAYMENT_STATUS='C';
              $WORKFLOW_STATUS='C';
              $REQUEST_STATUS='C';
              $TP="TP";
            }
            else{
              $PAYMENT_STATUS='IP';
              $WORKFLOW_STATUS='IP';
              $REQUEST_STATUS='IP';
              $TP="TNP";
            }
        }
        else{
          $LEFT_AMOUNT=$data['SERVICE_PRICE']-$data['PAID_AMOUNT'];
          if($LEFT_AMOUNT==0){
            $PAYMENT_STATUS='C';
            $WORKFLOW_STATUS='C';
            $REQUEST_STATUS='C';
            $TP="TP";
          }
          else{
            $PAYMENT_STATUS='IP';
            $WORKFLOW_STATUS='IP';
            $REQUEST_STATUS='IP';
            $TP="TNP";
          }
        }

        $paymentdata=[ 
          "REQ_ID"=>$data['REQ_ID'],
        "CARD_NO"=>$data['CARD_NO'],
        "CUS_ID"=>$data['CUS_ID'],
        "USER_ID"=>$_SESSION['user_id'],
        "PAID_AMOUNT"=>$data['PAID_AMOUNT'],
        "LEFT_AMOUNT"=>$LEFT_AMOUNT,
        "PAYMENT_AMOUNT"=>$data['SERVICE_PRICE'],
        "PAYMENT_STATUS"=>$PAYMENT_STATUS,
        "PAYMENT_TYPE"=>$data['PAYMENT_TYPE'],
        "SERVICE_CODE"=>$req_service->SERVICE_CODE,
        ];
        $paymentupdate=[ 
        "REQ_ID"=>$data['REQ_ID'],
        "PAID_AMOUNT"=>$data['PAID_AMOUNT'],
        "LEFT_AMOUNT"=>$LEFT_AMOUNT,
        "PAYMENT_STATUS"=>$PAYMENT_STATUS,
        ];
      
        if($this->process_payment($paymentdata,$paymentupdate,$paymentinfo)){
        if($this->update_queue_status($data['REQ_ID'],'cus_rcn_queue',"C",date("Y-m-d h:m:s"))){
        if($this->update_workflow_status($data['REQ_ID'],$WORKFLOW_STATUS,date("Y-m-d h:m:s"))){
        if($this->update_req_status($data['REQ_ID'],'req_rcn',$REQUEST_STATUS,"",date("Y-m-d h:m:s"),$TP)){
        if($paymentinfo==false){
          $noti_detail=$this->help->get_noti_detail($req_service->SERVICE_CODE);
          $major_ser_code=$this->help->getMajor_ser_code($req_service->SERVICE_CODE);
          $service_owner=$this->help->get_service_owner($major_ser_code);
          $req_id=strtoupper($service_owner->TAG).$this->help->get_last_id($service_owner->REQUEST);
          $user_info=$this->singleUserData($_SESSION['user_id']);
          $requestdata=[
            "TABLE_ID"=>$service_owner->REQUEST,
            "REQ_ID"=>$req_id,
          "CUS_ID"=> $data['CUS_ID'],
          "CARD_NO"=>$data['CARD_NO'],
          "USER_ID"=>$_SESSION['user_id'],
          "MAJOR_SER_CODE"=> $major_ser_code,
          "SERVICE_CODE"=>$req_service->SERVICE_CODE,
          "REQ_DESCI"=>strtoupper($noti_detail->DESCI." ".$data['CUS_NAME']),
          "REQ_STATUS"=>'P',
          "REQ_PAYMENT_STATUS"=>"F",
          "DONEBY"=>"",
          "REQ_TAKE_TIME"=>'',
          "REQ_DONE_TIME"=>'',
          "REQ_TYPE"=>$data['REQ_TYPE']
          ];
  
          if($this->add_req_rcn($requestdata))
          {
            $notidata=[ 
              "TABLE_ID"=>$service_owner->NOTIFICATION,
              "USER_ID"=>$_SESSION['user_id'],
              "MAJOR_SER_CODE"=>$major_ser_code,
              "SERVICE_CODE"=>$req_service->SERVICE_CODE,
              "CUS_ID"=>$data['CUS_ID'],
              "CARD_NO"=>$data['CARD_NO'],
              "REQ_ID"=>$req_id,
              "HEADER"=>$noti_detail->HEADER,
              "DESCI"=>$noti_detail->DESCI." ".$data['CUS_NAME'],];
              if($this->add_noti_rcn($notidata))
              {    
                $workflow_data=[ 
                  "REQ_ID"=>$req_id,
                  "REQ_CODE"=>$req_service->SERVICE_CODE,
                  "CARD_NO"=>$data['CARD_NO'],
                  "CUS_ID"=>$data['CUS_ID'],
                  "FLOW_FROM"=> $user_info->MAJOR_ACTOR,
                  "FLOW_SENDER"=>$_SESSION['user_id'],
                  "FLOW_TO"=>"",
                  "FLOW_DESCI"=>""];
                  if($this->add_workflow($workflow_data))
              {
                $queue_data=[ 
                  "TABLE_ID"=>$service_owner->QUEUE,
              "REQ_ID"=>$req_id,
              "CUS_ID"=>$data['CUS_ID'],
              "CARD_NO"=>$data['CARD_NO'],
              "MAJOR_SER_CODE"=>$major_ser_code,
              "SERVICE_CODE"=>$req_service->SERVICE_CODE,
              "CARDTYPE"=>"",
              "DATE_CREATED"=>date("Y-m-d h:m:s"),
              "CUS_NAME"=>$data['CUS_NAME'],
              "FORWARD_FROM"=>$_SESSION['user_id'],
              "STATUS"=>"P",
              "QUEUE_CLOSED_TIME"=>"",
              "REQ_TYPE"=>$data['REQ_TYPE']];
              if($this->add_queue($queue_data))
              return true;
              else
              return false;
              }else{
                  return false;
              }
                  
              }
              else{
                return false;
              }
          }
          else{
            return false;
          }
        }  
        else{
         return true;
        }
       

        }
        else{
        return false;
        }
        }
        else{
        return false;
        }
        }
        else{
        return false;
        }
        }
        else{
        return false;
        }

        }

        public function add_gen_data($data){
          $service_owner=$this->help->get_service_owner($data['MAJOR_SER_CODE']);
          $get_payment_status=$this->get_payment_info($data['REQ_ID'],$service_owner->REQUEST);
          $age=$this->get_age($data['CUS_ID']);

              $gen_data=[
              "CARD_NO"=>$data['CARD_NO'],
              "CUS_ID"=>$data['CUS_ID'],
              "CUS_NAME"=> $data['CUS_NAME'],
              "CARD_NO"=>$data['CARD_NO'],
              "USER_ID"=>$_SESSION['user_id'],
              "AGE"=> $age,
              "TEMPRATURE"=>$data['TEMPRATURE'],
              "PULSE_RATE"=>$data['PULSE_RATE'],
              "WEIGHT"=>$data['WEIGHT'],
              "HEIGHT"=>$data['HEIGHT'],
              "SYSTOLICBP"=>$data['SYSTOLICBP'],
              "DIASTOLICBP"=>$data['DIASTOLICBP'],
              ];

        if($this->add_gen($gen_data)){
        if($this->update_queue_status($data['REQ_ID'],'cus_rcn_queue',"C",date("Y-m-d h:m:s"))){
        if($this->update_workflow_status($data['REQ_ID'],"C",date("Y-m-d h:m:s"))){
        if($this->update_req_status($data['REQ_ID'],'req_rcn',"C","",date("Y-m-d h:m:s"),$get_payment_status)){
      if($data['M_SER_CODE']!=null){
        $major_ser_code=$this->help->getMajor_ser_code($data['M_SER_CODE']);
        $service_owner=$this->help->get_service_owner($major_ser_code);
        
          $noti_detail=$this->help->get_noti_detail($data['M_SER_CODE']);
          $req_id=strtoupper($service_owner->TAG).$this->help->get_last_id($service_owner->REQUEST);
          $user_info=$this->singleUserData($_SESSION['user_id']);
        $requestdata=[
          "TABLE_ID"=>$service_owner->REQUEST,
          "REQ_ID"=>$req_id,
        "CUS_ID"=> $data['CUS_ID'],
        "CARD_NO"=>$data['CARD_NO'],
        "USER_ID"=>$_SESSION['user_id'],
        "MAJOR_SER_CODE"=> $major_ser_code,
        "SERVICE_CODE"=>$data['M_SER_CODE'],
        "REQ_DESCI"=>strtoupper($noti_detail->DESCI." ".$data['CUS_NAME']),
        "REQ_STATUS"=>'P',
        "REQ_PAYMENT_STATUS"=>"F",
        "DONEBY"=>"",
        "REQ_TAKE_TIME"=>'',
        "REQ_DONE_TIME"=>'',
        "REQ_TYPE"=>$data['REQ_TYPE']
        ];

        if($this->add_req_rcn($requestdata))
        {
          $notidata=[ 
            "TABLE_ID"=>$service_owner->NOTIFICATION,
            "USER_ID"=>$_SESSION['user_id'],
            "MAJOR_SER_CODE"=>$major_ser_code,
            "SERVICE_CODE"=>$data['M_SER_CODE'],
            "CUS_ID"=>$data['CUS_ID'],
            "CARD_NO"=>$data['CARD_NO'],
            "REQ_ID"=>$req_id,
            "HEADER"=>$noti_detail->HEADER,
            "DESCI"=>$noti_detail->DESCI." ".$data['CUS_NAME'],];
            if($this->add_noti_rcn($notidata))
            {    
              $workflow_data=[ 
                "REQ_ID"=>$req_id,
                "REQ_CODE"=>$data['M_SER_CODE'],
                "CARD_NO"=>$data['CARD_NO'],
                "CUS_ID"=>$data['CUS_ID'],
                "FLOW_FROM"=> $user_info->MAJOR_ACTOR,
                "FLOW_SENDER"=>$_SESSION['user_id'],
                "FLOW_TO"=>"",
                "FLOW_DESCI"=>""];
                if($this->add_workflow($workflow_data))
            {
              $queue_data=[ 
                "TABLE_ID"=>$service_owner->QUEUE,
            "REQ_ID"=>$req_id,
            "CUS_ID"=>$data['CUS_ID'],
            "CARD_NO"=>$data['CARD_NO'],
            "MAJOR_SER_CODE"=>$major_ser_code,
            "SERVICE_CODE"=>$data['M_SER_CODE'],
            "CARDTYPE"=>"",
            "DATE_CREATED"=>date("Y-m-d h:m:s"),
            "CUS_NAME"=>$data['CUS_NAME'],
            "FORWARD_FROM"=>$_SESSION['user_id'],
            "STATUS"=>"P",
            "QUEUE_CLOSED_TIME"=>"",
            "REQ_TYPE"=>$data['REQ_TYPE']];
            if($this->add_queue($queue_data))
            return true;
            else
            return false;
            }else{
                return false;
            }
                
            }
            else{
              return false;
            }
        }
        else{
          return false;
        }
      
      
      } 
      
      else{
        return true;
      }
         
         
       

        }
        else{
        return false;
        }
        }
        else{
        return false;
        }
        }
        else{
        return false;
        }
        }
        else{
        return false;
        }

        }

        public function add_mcare_data($data){
          
          $age=$this->get_age($data['CUS_ID']);
          $total_days=(($data['DOSE_COUNT']/$data['DOSE_COUNT_SINGLE'])*$data['HOUR_DIFF'])-$data['HOUR_DIFF'];
          $timezone= new DateTimeZone('GMT+3');
          
          $today=DateTime::createFromFormat('Y-m-d H:i',$data['CARE_START_TIME'],$timezone);
          date_add($today, date_interval_create_from_date_string($total_days.' hours'));
          $DATE_COMPLETE= date_format($today, 'Y-m-d H:i A');

              $this->db->query('INSERT INTO `inpatient_care_major`(`CUS_ID`, `CARD_NO`, `BED_ID`, `REQUIRE_TREAT`, `DATE_COMPLETE`, `CARE_START_TIME`, `CARE_CREAT_BY`, `DOSE_COUNT`,`DOSE_COUNT_SINGLE`, `HOUR_DIFF`, `MAX_TIME_LIMIT`, `DOSE_LIST`) 
              VALUES (:CUS_ID,:CARD_NO,:BED_ID,:REQUIRE_TREAT,:DATE_COMPLETE,:CARE_START_TIME,:CARE_CREAT_BY,:DOSE_COUNT,:DOSE_COUNT_SINGLE,:HOUR_DIFF,:MAX_TIME_LIMIT,:DOSE_LIST)');

              $this->db->bind(':CUS_ID', $data['CUS_ID']);
              $this->db->bind(':CARD_NO', $data['CARD_NO']);
              $this->db->bind(':BED_ID', $data['BED_ID']);
              $this->db->bind(':REQUIRE_TREAT', $data['REQUIRE_TREAT']);
              $this->db->bind(':DATE_COMPLETE',  $DATE_COMPLETE);
              $this->db->bind(':CARE_START_TIME', $data['CARE_START_TIME']);
              $this->db->bind(':CARE_CREAT_BY', $_SESSION['user_id']);
              $this->db->bind(':DOSE_COUNT', $data['DOSE_COUNT']);
              $this->db->bind(':DOSE_COUNT_SINGLE', $data['DOSE_COUNT_SINGLE']);
              $this->db->bind(':HOUR_DIFF', $data['HOUR_DIFF']);
              $this->db->bind(':MAX_TIME_LIMIT', '30');
              $this->db->bind(':DOSE_LIST', $data['DOSE_LIST']);
   
        if($this->db->execute()){
          $TIME=DateTime::createFromFormat('Y-m-d H:i',$data['CARE_START_TIME'],$timezone);
          $COUNTER=$data['DOSE_COUNT']/$data['DOSE_COUNT_SINGLE'];
          $REQUIRED_TIME= date_format($TIME, 'Y-m-d H:i A');
          for($i=1;$i<=$COUNTER;$i++){
           
            $REQUIRED_TIME= date_format($TIME, 'Y-m-d H:i A');
            $this->db->query('INSERT INTO `inpatient_care_daily`(`CUS_ID`, `CARD_NO`, `BED_ID`, `CARE_GIVEN_BY`, `REQUIRE_TREAT`, `REQUIRED_TIME`) 
            VALUES (:CUS_ID,:CARD_NO,:BED_ID,:CARE_GIVEN_BY,:REQUIRE_TREAT,:REQUIRED_TIME)');


            $this->db->bind(':CUS_ID', $data['CUS_ID']);
            $this->db->bind(':CARD_NO', $data['CARD_NO']);
            $this->db->bind(':BED_ID', $data['BED_ID']);
            $this->db->bind(':CARE_GIVEN_BY', 'NULL');
            $this->db->bind(':REQUIRE_TREAT', $data['DOSE_LIST']);
            $this->db->bind(':REQUIRED_TIME',  $REQUIRED_TIME);
            $this->db->execute();
            date_add($TIME, date_interval_create_from_date_string($data['HOUR_DIFF'].' hours'));
          }
          return true;
        }
        else{
              return false;
        }
      }
     
      public function complete_care($ID){
        $timezone= new DateTimeZone('GMT+3');
            $NOW=DateTime::createFromFormat('Y-m-d H:i',date("Y-m-d h:m:s"),$timezone);
            $TIME_GIVEN=date_format(new DateTime($NOW), 'Y-m-d H:i A');
        $this->db->query("UPDATE `inpatient_care_daily` SET `CARE_GIVEN_BY`=:CARE_GIVEN_BY,`TIME_GIVEN`=:TIME_GIVEN,`CARE_STATUS`=:CARE_STATUS WHERE `ID`=:ID");
  
  
        // Bind Values
        $this->db->bind(':CARE_GIVEN_BY',$_SESSION['user_id']);
        $this->db->bind(':TIME_GIVEN', $TIME_GIVEN);
        $this->db->bind(':CARE_STATUS','C');
        $this->db->bind(':ID',$ID);
        if($this->db->execute()){
        return true;
        } else {
        return false;
        }
        } 

        public function get_daily_care($CARD_NO,$CARE_STATUS){
          $output = array('data' => array());
          $CARD_NO='CARD'.$CARD_NO;
          $this->db->query("SELECT * FROM `inpatient_care_daily` where  `CARD_NO`=:CARD_NO AND `CARE_STATUS`=:CARE_STATUS ");
          $this->db->bind(':CARD_NO', $CARD_NO);
          $this->db->bind(':CARE_STATUS', $CARE_STATUS);
          $result = $this->db->resultsetASSO();
          $fullcount=$this->db->rowCount();
        $x=1;
        if($result!=null){
          foreach ($result as $row ) {
            $CUSTOMER_DETAIL='<a  data-toggle="modal" data-target="#showCusModal" onclick="get_user_data(\''.$row['CUS_ID'].'\')" class="" style="list-style-type:none"> '.$row['CUS_ID'].'</a>';
        
            $output['data'][] = array(
              "COUNTER"=>$x,
              "SIZE"=>$fullcount,
              "ID"=>$row['ID'],
              "CUS_ID"=>$CUSTOMER_DETAIL,
             "CARD_NO"=>$row['CARD_NO'],
              "BED_ID"=>$row['BED_ID'],
              "CARE_GIVEN_BY"=>$row['CARE_GIVEN_BY'],
              "REQUIRE_TREAT"=>$row['REQUIRE_TREAT'],
              "REQUIRED_TIME"=>$row['REQUIRED_TIME'],
              "TIME_GIVEN"=>$row['TIME_GIVEN'],
              "CARE_STATUS"=>$row['CARE_STATUS'],
            );
            $x++;
        
          }
          return $output;
        }
        else{
          $output['data'][] = array(
            "OUTPUT"=>false
                  );
                  return $output;
        }
       
        }
      

       
        public function process_payment($paymentdata,$paymentupdate,$paymentinfo){
            if($paymentinfo==false){
             if( $this->add_payment($paymentdata)){
                if($this->add_payment_history($paymentdata)){
                  return true;
                }
                else{
                  return false;
                }
             }
             else{
               return false;
             }
            }
            else{
                if($this->update_payment($paymentupdate)){
                  if($this->add_payment_history($paymentdata)){
                    return true;
                  }
                  else{
                    return false;
                  }
                }
                else
                return false;
            }
        }
        public function add_payment_history($data){
    
          // Prepare Query 
        $this->db->query("INSERT INTO `payment_history`(`REQ_ID`,`CARD_NO`,`CUS_ID`, `USER_ID`,`PAYMENT_TYPE`,`PAID_AMOUNT`,`LEFT_AMOUNT`, `PAYMENT_AMOUNT`, 
        `PAYMENT_STATUS`,  `SERVICE_CODE`)                                     
        VALUES (:REQ_ID,:CARD_NO,:CUS_ID,:USER_ID,:PAYMENT_TYPE,:PAID_AMOUNT,:LEFT_AMOUNT,:PAYMENT_AMOUNT,:PAYMENT_STATUS,:SERVICE_CODE)");
        
        
        // Bind Values
        $this->db->bind(':REQ_ID', $data['REQ_ID']);
        $this->db->bind(':CARD_NO', $data['CARD_NO']);
        $this->db->bind(':CUS_ID', $data['CUS_ID']);
        $this->db->bind(':USER_ID', $data['USER_ID']);
        $this->db->bind(':PAYMENT_TYPE', $data['PAYMENT_TYPE']);
        $this->db->bind(':PAID_AMOUNT', $data['PAID_AMOUNT']);
        $this->db->bind(':LEFT_AMOUNT', $data['LEFT_AMOUNT']);
        $this->db->bind(':PAYMENT_AMOUNT', $data['PAYMENT_AMOUNT']);
        $this->db->bind(':PAYMENT_STATUS', $data['PAYMENT_STATUS']);
        $this->db->bind(':SERVICE_CODE', $data['SERVICE_CODE']);
        
        if($this->db->execute()){
        return true;
        } else {
        return false;
        }
        }
        public function getservice(){
          $output = array('data' => array());
          $this->db->query("SELECT s.SERVICE_CODE,s.SERVICE_NAME,s.PRICE  FROM `ser_list` s INNER JOIN (SELECT `MAJOR_SER_CODE` FROM `ser_gen_catagory` WHERE PRICE_REQU='T') m ON s.MAJOR_SER_CODE = m.MAJOR_SER_CODE where s.SERVICE_STATUS = 'EN'");
          $result = $this->db->resultset();
          $fullcount=$this->db->rowCount();
      
        return $result;
        }
        public function update_payment($data){
    
          // Prepare Query 
        $this->db->query("UPDATE `pre_service_payments` SET `PAID_AMOUNT`=:PAID_AMOUNT,`LEFT_AMOUNT`=:LEFT_AMOUNT,`PAYMENT_STATUS`=:PAYMENT_STATUS,`DATE_MODI`=:DATE_MODI");
        
        
        // Bind Values
        $this->db->bind(':PAID_AMOUNT', $data['PAID_AMOUNT']);
        $this->db->bind(':LEFT_AMOUNT', $data['LEFT_AMOUNT']);
        $this->db->bind(':PAYMENT_STATUS', $data['PAYMENT_STATUS']);
        $this->db->bind(':DATE_MODI',date("Y-m-d h:m:s"));
      
        
        if($this->db->execute()){
        return true;
        } else {
        return false;
        }
        }

public function add_payment($data){
    
  // Prepare Query 
$this->db->query("INSERT INTO `pre_service_payments`(`REQ_ID`,`CARD_NO`,`CUS_ID`, `USER_ID`,`PAID_AMOUNT`,`LEFT_AMOUNT`,  `PAYMENT_AMOUNT`, 
`PAYMENT_STATUS`, `PAYMENT_TYPE`, `SERVICE_CODE`)                                     
VALUES (:REQ_ID,:CARD_NO,:CUS_ID,:USER_ID,:PAID_AMOUNT,:LEFT_AMOUNT,:PAYMENT_AMOUNT,:PAYMENT_STATUS,:PAYMENT_TYPE,:SERVICE_CODE)");


// Bind Values
$this->db->bind(':REQ_ID', $data['REQ_ID']);
$this->db->bind(':CARD_NO', $data['CARD_NO']);
$this->db->bind(':CUS_ID', $data['CUS_ID']);
$this->db->bind(':USER_ID', $data['USER_ID']);
$this->db->bind(':PAID_AMOUNT', $data['PAID_AMOUNT']);
$this->db->bind(':LEFT_AMOUNT', $data['LEFT_AMOUNT']);
$this->db->bind(':PAYMENT_AMOUNT', $data['PAYMENT_AMOUNT']);
$this->db->bind(':PAYMENT_STATUS', $data['PAYMENT_STATUS']);
$this->db->bind(':PAYMENT_TYPE', $data['PAYMENT_TYPE']);
$this->db->bind(':SERVICE_CODE', $data['SERVICE_CODE']);

if($this->db->execute()){
return true;
} else {
return false;
}
}
     
public function update_status($data){
  $service_owner=$this->help->get_service_owner($data['MAJOR_SER_CODE']);

  if($this->update_queue_status($data['REQ_ID'],'cus_rcn_queue',"IP",""))
     if($this->update_workflow_status($data['REQ_ID'],"IP","")){
      if($this->update_req_status($data['REQ_ID'],'req_rcn',"IP",date("Y-m-d h:m:s"),"",$data['REQ_PAYMENT_STATUS'])){
          return true;
      }
      else{
        return false;
      }
     }
     else{
       return false;
     }
   else{
     return false;
   }
  } 


  public function change_status_all($data){
    $service_owner=$this->help->get_service_owner($data['MAJOR_SER_CODE']);
    $get_payment_status=$this->get_payment_info($data['REQ_ID'],$service_owner->REQUEST);
  
    if($this->update_queue_status($data['REQ_ID'],$service_owner->QUEUE,"IP",""))
       if($this->update_workflow_status($data['REQ_ID'],"IP","")){
        if($this->update_req_status($data['REQ_ID'],$service_owner->REQUEST,"IP",date("Y-m-d h:m:s"),"", $get_payment_status)){
            return true;
        }
        else{
          return false;
        }
       }
       else{
         return false;
       }
     else{
       return false;
     }
    } 
  public function update_queue_status($REQ_ID,$table_id,$STATUS,$QUEUE_CLOSED_TIME){
    
    // Prepare Query 
  $this->db->query("UPDATE `".$table_id."` SET `STATUS`=:STATUSS,`QUEUE_CLOSED_TIME`=:QUEUE_CLOSED_TIME WHERE `REQ_ID`=:REQ_ID");


  // Bind Values
  $this->db->bind(':REQ_ID',$REQ_ID);
  $this->db->bind(':STATUSS',$STATUS);
  $this->db->bind(':QUEUE_CLOSED_TIME',$QUEUE_CLOSED_TIME);
 
  if($this->db->execute()){
  return true;
  } else {
  return false;
  }
  }

  public function update_workflow_status($REQ_ID,$REQ_STATUS,$DATE_COMPLETED){
    
    $this->db->query("UPDATE `cus_workflow` SET `REQ_STATUS`=:REQ_STATUS,`FLOW_RECEIVER`=:FLOW_RECEIVER,`DATE_COMPLETED`=:DATE_COMPLETED WHERE `REQ_ID`=:REQ_ID");


  // Bind Values
  $this->db->bind(':REQ_ID',$REQ_ID);
  $this->db->bind(':REQ_STATUS',$REQ_STATUS);
  $this->db->bind(':DATE_COMPLETED',$DATE_COMPLETED);
  $this->db->bind(':FLOW_RECEIVER',$_SESSION['user_id']);

  if($this->db->execute()){
  return true;
  } else {
  return false;
  }
  }

  public function update_req_status($REQ_ID,$table_id,$REQ_STATUS,$REQ_TAKE_TIME,$REQ_DONE_TIME,$REQ_PAYMENT_STATUS){
    if($REQ_TAKE_TIME==""){
      $this->db->query("UPDATE `".$table_id."`  SET `REQ_STATUS`=:REQ_STATUS,`DONEBY`=:DONEBY,`REQ_DONE_TIME`=:REQ_DONE_TIME,`REQ_PAYMENT_STATUS`=:REQ_PAYMENT_STATUS WHERE `REQ_ID`=:REQ_ID");
// Bind Values
$this->db->bind(':REQ_ID',$REQ_ID);
$this->db->bind(':REQ_STATUS',$REQ_STATUS);
  $this->db->bind(':DONEBY',$_SESSION['user_id']);
  $this->db->bind(':REQ_DONE_TIME',$REQ_DONE_TIME);
  $this->db->bind(':REQ_PAYMENT_STATUS',$REQ_PAYMENT_STATUS);
    }
    else{
      $this->db->query("UPDATE `".$table_id."`  SET `REQ_STATUS`=:REQ_STATUS,`DONEBY`=:DONEBY, `REQ_TAKE_TIME`=:REQ_TAKE_TIME,`REQ_DONE_TIME`=:REQ_DONE_TIME WHERE `REQ_ID`=:REQ_ID");
      // Bind Values
      $this->db->bind(':REQ_ID',$REQ_ID);
      $this->db->bind(':REQ_STATUS',$REQ_STATUS);
        $this->db->bind(':DONEBY',$_SESSION['user_id']);
        $this->db->bind(':REQ_TAKE_TIME',$REQ_TAKE_TIME);
        $this->db->bind(':REQ_DONE_TIME',$REQ_DONE_TIME);
    }
  
if($this->db->execute()){
 return true;
} else {
 return false;
}
}
  
  }