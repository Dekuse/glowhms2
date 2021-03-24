<?php
  class func extends Controller {
    private $db;
    public function __construct(){
      $this->db = new Database;
      $this->filer = $this->filemethods('Fileoperations');
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

    public function getmajorservice2(){
        
      $output = array('data' => array());
      $this->db->query("SELECT * FROM `ser_gen_catagory` where `PRICE_REQU`!='F' ");
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


    public function getbed_data($customername,$customerid){
      $flag=0;
      $query='';
      if($customername == null && $customerid == null ){
        $output['data'][] = array(
          "OUTPUT"=>false
                );
                return $output;
      }
      else{
        if($customername != null && $customerid== null){
          $query = "select c.CARD_NO,c.BED_ID,c.MAJOR_BDR_CODE,c.DATE_CREATE,c.DATE_LEAVE,d.CUS_NAME,d.CUS_ID from `cus_bed_status` c  INNER JOIN (SELECT `CUS_NAME`,`CUS_ID` FROM `customer_detail` WHERE CUS_NAME LIKE '".$customername."' ) d ON c.CUS_ID = d.CUS_ID";

        }
        else if($customername !=null && $customerid!=null){
          $cus_id='CUS'.$customerid;
          $query = "select c.CARD_NO,c.CUS_ID,c.BED_ID,c.MAJOR_BDR_CODE,c.DATE_CREATE,c.DATE_LEAVE,d.CUS_NAME from `cus_bed_status` c  INNER JOIN (SELECT `CUS_NAME`,`CUS_ID` FROM `customer_detail` WHERE CUS_NAME LIKE '".$customername."' ) d ON c.CUS_ID = d.CUS_ID WHERE c.CUS_ID='".$cus_id."'";
        }
       elseif ($customername==null && $customerid!=null) {
        $cus_id='CUS'.$customerid;
        $query = "select  c.CARD_NO,c.CUS_ID,c.BED_ID,c.MAJOR_BDR_CODE,c.DATE_CREATE,c.DATE_LEAVE,d.CUS_NAME from `customer_detail` d  INNER JOIN (SELECT CARD_NO,CUS_ID,BED_ID,MAJOR_BDR_CODE,DATE_CREATE,DATE_LEAVE FROM `cus_bed_status` WHERE CUS_ID= '".$cus_id."') c ON c.CUS_ID = d.CUS_ID";

       }
       
       
     $this->db->query($query);
     
     $result = $this->db->resultsetASSO();
    $fullcount=$this->db->rowCount();
  $x=1;
  if($result!=NULL){
    foreach ($result as $row ) {
     
      $output['data'][] = array(
        "COUNTER"=>$x,
        "SIZE"=>$fullcount,
       "CARD_NO"=>$row['CARD_NO'],
       "CUS_ID"=>$row['CUS_ID'],
        "BED_ID"=>$row['BED_ID'],
        "MAJOR_BDR_CODE"=>$row['MAJOR_BDR_CODE'],
        "DATE_CREATE"=>$row['DATE_CREATE'],
         "DATE_LEAVE"=>$row['DATE_LEAVE'],
         "CUS_NAME"=>$row['CUS_NAME'],
        
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

  }

  public function get_bedstatus($BED_STATUS){
    $flag=0;
    $result;
    $fullcount;
    $query="SELECT m.ID,m.BEDROOM_TYPE,m.BEDROOM_PRICE,m.BEDROOM_AVAIBILITY,m.BR_HELD_BY FROM `bedroom` m ";

    if($BED_STATUS == null ){
      $query="SELECT m.ID,m.BEDROOM_TYPE,m.BEDROOM_PRICE,m.BEDROOM_AVAIBILITY,m.BR_HELD_BY FROM `bedroom` m ";
      $this->db->query($query);
   
      $result = $this->db->resultsetASSO();
     $fullcount=$this->db->rowCount();
    }
    else{
        $query.="where m.BEDROOM_AVAIBILITY='".$BED_STATUS."' ";
   $this->db->query($query);
   
   $result = $this->db->resultsetASSO();
  $fullcount=$this->db->rowCount();
    }

if($result!=NULL){
  foreach ($result as $row ) {
    if($row['BR_HELD_BY'] !=null){
          
      $heldby='<a   data-toggle="modal" data-target="#showCusModal" onclick="get_user_data(\''.$row['BR_HELD_BY'].'\')" class="" style="list-style-type:none">  '.$row['BR_HELD_BY']. '</a>';
    }
    else{
      $heldby='';
  
    }

    $output['data'][] = array(
      "SIZE"=>$fullcount,
     "ID"=>$row['ID'],
     "BEDROOM_TYPE"=>$row['BEDROOM_TYPE'],
      "BEDROOM_PRICE"=>$row['BEDROOM_PRICE'],
      "BEDROOM_AVAIBILITY"=>$row['BEDROOM_AVAIBILITY'],
      "BR_HELD_BY"=>$heldby,
    
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