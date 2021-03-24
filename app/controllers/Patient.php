<?php
  class Patient extends Controller{
    public $userdetails;
    public function __construct(){
      if(!isset($_SESSION['user_id']) || userSessionX() ){
        logout();
      }
     $this->custModel = $this->model('cust');
     $this->filer = $this->filemethods('Fileoperations');
     $this->userdetails=$this->custModel->getUserInfo();
     $this->registerModel = $this->model('register');
     $this->patModel = $this->model('pat');
     $this->help = $this->model('helpmethods');
    }

    public function logOut(){
      logout();
  }
  public function general_test(){

    if($_GET){
      $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
      $cus_data=$this->custModel->singleCusData($_GET['CUS_ID']);
      $general_detail=$this->custModel->get_gendet_result($_GET['CARD_NO']);
       $data = [
         'username' => $this->userdetails->FULL_NAME,
         'email'=>$this->userdetails->EMAIL,
         'pagename'=>"GENERAL TEST",
         'cus_data'=>$cus_data,
         'general_detail'=>$general_detail,
       ];
       $this->view('patient/general_test', $data);
    }
    else{

    }
  }

  public function count(){

    if($_GET){
      $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
      $count_information=$this->patModel->count($_GET['CARD_NO']);
      echo json_encode($count_information);
    }
    else{
        echo "error occured";
    }
  }

  public function dispatch(){

    if($_GET){
      $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
      if($_GET['REQUEST']=='IMI'){
        $this->loaddata('cus_imi_test_result',$_GET['CARD_NO']);
      }
      if($_GET['REQUEST']=='GEN'){
        $this->loaddata('cus_doc_result',$_GET['CARD_NO']);
      }
      if($_GET['REQUEST']=='LAB'){
        $this->loaddata('cus_lab_test_result',$_GET['CARD_NO']);
      }
      
     
    }
    else{
        echo "error occured";
    }
  }

  public function loaddata($from,$CARD_NO){
    
    $All_data=json_decode( $this->patModel->get_data($from,$CARD_NO),true);
    $Count_data=$this->patModel->count_gen_data($from,$CARD_NO);
    if($Count_data > 0 && $All_data != false){
      
for($i=0;$i<$Count_data;$i++){
  $MADE_BY='<a  data-toggle="modal" data-target="#showUserModal" onclick="showUser(\''.$All_data[$i]['USER_ID'].'\')" class="" style="list-style-type:none">  '.$All_data[$i]['USER_ID'].'</a>';

$show= '<div class="box box-title with-border "><div class="">
                   <p>General test results</p>
                    <p class="">
                      
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>'. $All_data[$i]['DATE_CREATED'].'</small>
                        <span>Made By </span>'.$MADE_BY.'
                      </p><p><h4>TEST FINDINGS</h4></p><p>'.
                      $All_data[$i]['TEST_FINDING'].'
                    </p>
                    
                  ';
              if($All_data[$i]['GEN_CONCLU']!=null){
                $show.='<p><h4>CONCLUSIONS</h4></p> <p class="message">'.
                $All_data[$i]['GEN_CONCLU'].'
              </p>';
              }
              
              $show.='</div></div>';
         echo $show;  
}
  }

    else{
echo false;
    }
 
}
 
 
  }