<?php
  class pat extends Controller {
    private $db;
    public function __construct(){
      $this->db = new Database;
      $this->filer = $this->filemethods('Fileoperations');
      $this->help = $this->model('helpmethods');
      $this->cust = $this->model('cust');
    }
    public function count($CARD_NO){
      $count_file=[
        "lab_t"=>'',
        "lab_c"=>'',
        "lab_p"=>'',
        "imi_t"=>'',
        "imi_c"=>'',
        "imi_p"=>'',
        ];
      $this->db->query("SELECT `CARD_NO` FROM `req_imidoc` WHERE `CARD_NO`=:CARD_NO AND `REQ_STATUS`=:REQ_STATUS ");
      $this->db->bind(':CARD_NO',$CARD_NO);
      $this->db->bind(':REQ_STATUS','C');
      $this->db->resultset();
      $count_file['imi_c']=$this->db->rowCount();
      $this->db->query("SELECT `CARD_NO` FROM `req_imidoc` WHERE `CARD_NO`=:CARD_NO AND `REQ_STATUS`=:REQ_STATUS OR `REQ_STATUS`=:REQ_STATUS2  ");
      $this->db->bind(':CARD_NO',$CARD_NO);
      $this->db->bind(':REQ_STATUS','P');
      $this->db->bind(':REQ_STATUS2','IP');
      $this->db->resultset();
      $count_file['imi_p']=$this->db->rowCount();
      $this->db->query("SELECT `CARD_NO` FROM `req_imidoc` WHERE `CARD_NO`=:CARD_NO   ");
      $this->db->bind(':CARD_NO',$CARD_NO);
      $this->db->resultset();
      $count_file['imi_t']=$this->db->rowCount();

      $this->db->query("SELECT `CARD_NO` FROM `req_labdoc` WHERE `CARD_NO`=:CARD_NO AND `REQ_STATUS`=:REQ_STATUS ");
      $this->db->bind(':CARD_NO',$CARD_NO);
      $this->db->bind(':REQ_STATUS','C');
      $this->db->resultset();
      $count_file['lab_c']=$this->db->rowCount();
      $this->db->query("SELECT `CARD_NO` FROM `req_labdoc` WHERE `CARD_NO`=:CARD_NO AND `REQ_STATUS`=:REQ_STATUS OR `REQ_STATUS`=:REQ_STATUS2  ");
      $this->db->bind(':CARD_NO',$CARD_NO);
      $this->db->bind(':REQ_STATUS','P');
      $this->db->bind(':REQ_STATUS2','IP');
      $this->db->resultset();
      $count_file['lab_p']=$this->db->rowCount();
      $this->db->query("SELECT `CARD_NO` FROM `req_labdoc` WHERE `CARD_NO`=:CARD_NO   ");
      $this->db->bind(':CARD_NO',$CARD_NO);
      $this->db->resultset();
      $count_file['lab_t']=$this->db->rowCount();

      return  $count_file;
    }

    public function count_gen_data($from,$CARD_NO){
    
      $this->db->query("SELECT `CARD_NO` FROM `".$from."` WHERE  `CARD_NO`=:CARD_NO ");
    
      $this->db->bind(':CARD_NO',$CARD_NO);
      $this->db->resultset();
     return $this->db->rowCount();
    }

    public function get_data($from,$CARD_NO){
      $status="Not Seen";
      $this->db->query("SELECT * FROM `".$from."` WHERE  `CARD_NO`=:CARD_NO ORDER by DATE_CREATED DESC ");
      $this->db->bind(':CARD_NO',$CARD_NO);
     $row = $this->db->single();
      if($this->db->rowCount() > 0){
        return json_encode( $this->db->resultset());
      } else {
        return false;
      }
     
    }
  }