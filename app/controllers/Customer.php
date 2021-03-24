<?php
  class Customer extends Controller{
    public $userdetails;
    public function __construct(){
      if(!isset($_SESSION['user_id']) || userSessionX() ){
        logout();
      }
     $this->custModel = $this->model('cust');
     $this->filer = $this->filemethods('Fileoperations');
     $this->userdetails=$this->custModel->getUserInfo();
     $this->registerModel = $this->model('register');
     $this->help = $this->model('helpmethods');
    }

    public function logOut(){
      logout();
  }
 
  public function index(){
    $nation=$this->registerModel->getInput('lu_nation'); 
    $region=$this->registerModel->getInput('lu_region'); 
    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"REGISTER CUSTOMER",
      'nation'=>$nation,
      'region'=>$region
    ];
    $this->view('customer/regcustomer', $data);
  }

  public function getworkflow(){
   
    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"WORKFLOW",
      
    ];
    $this->view('customer/workflow', $data);
  }

  public function appointment(){
   
    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"APPOINTMENT",
      
    ];
    $this->view('customer/appointment', $data);
  }

  public function process_payments(){
    $card_data=$this->custModel->get_card_detail();
    $nation=$this->registerModel->getInput('lu_nation'); 
    $region=$this->registerModel->getInput('lu_region'); 
    $services=$this->custModel->getservice();

    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"PROCESS PAYMENT",
      'card_data'=> $card_data,
      'nation'=>$nation,
      'region'=>$region,
      'services'=>$services
    ];
    $this->view('customer/pro_payment', $data);
  }

  public function general_detail(){
    $card_data=$this->custModel->get_card_detail();
    $nation=$this->registerModel->getInput('lu_nation'); 
    $region=$this->registerModel->getInput('lu_region'); 
    $services=$this->custModel->getservice();

    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"GENERAL DETAIL",
      'card_data'=> $card_data,
      'nation'=>$nation,
      'region'=>$region,
      'services'=>$services
    ];
    $this->view('customer/gen_detail', $data);
  }

  public function requests(){
   
    $roles=$this->help->getRole();

    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"REQUESTS",
  
      'roles'=>$roles,
    ];
    $this->view('customer/requests', $data);
  }

  public function notifications(){
   
    $roles=$this->help->getRole();

    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"NOTIFICATIONS",
  
      'roles'=>$roles,
    ];
    $this->view('customer/notifications', $data);
  }



  public function config_care(){
    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"CONFIGURE DAILY CARE",
    ];
    $this->view('customer/configure_care', $data);
  }

  public function daily_Care(){
    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"DAILY CARE",
    ];
    $this->view('customer/daily_care', $data);
  }

  public function test_script(){
  

    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"DAILY CARE",
    ];
    $this->view('customer/test_script', $data);
  }

  public function getcusdata(){
   
     
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $date1=substr($_POST['regdate'],0,strpos($_POST['regdate']," ",0));
      $date2=substr($_POST['regdate'],((strpos($_POST['regdate'],"-",9)+1)));
      $customerdata=$this->custModel->getcusdata($date1,$date2,$_POST['customername'],$_POST['customerid'],$_POST['userid']);
      echo json_encode($customerdata);
    }
    
  }
  

  public function getappdata(){
   
     
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $date1=substr($_POST['appdate'],0,strpos($_POST['appdate']," ",0));
      $date2=substr($_POST['appdate'],((strpos($_POST['appdate'],"-",9)+1)));
      $appdata=$this->custModel->getappdata($date1,$date2,$_POST['apptype'],$_POST['appstatus'],$_POST['cardid']);
      echo json_encode($appdata);
    }
    
  }

  public function getpayment(){
   
     
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $date1=substr($_POST['REQ_DATE'],0,strpos($_POST['REQ_DATE']," ",0));
      $date2=substr($_POST['REQ_DATE'],((strpos($_POST['REQ_DATE'],"-",9)+1)));
      $appdata=$this->custModel->getpayment($date1,$date2,$_POST['PAY_TYPE'],$_POST['PAY_STATUS'],$_POST['CARD_ID'],$_POST['CUS_ID'],$_POST['CUSTOMER_NAME']);
      echo json_encode($appdata);
    }
    
  }

  public function get_gen_detail(){
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $date1=substr($_POST['REQ_DATE'],0,strpos($_POST['REQ_DATE']," ",0));
      $date2=substr($_POST['REQ_DATE'],((strpos($_POST['REQ_DATE'],"-",9)+1)));
      $appdata=$this->custModel->get_gen_detail($date1,$date2,$_POST['REQ_STATUS'],$_POST['CARD_ID'],$_POST['CUS_ID'],$_POST['CUSTOMER_NAME']);
      echo json_encode($appdata);
    }
  }

  public function get_requests(){
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $date1=substr($_POST['REQ_DATE'],0,strpos($_POST['REQ_DATE']," ",0));
      $date2=substr($_POST['REQ_DATE'],((strpos($_POST['REQ_DATE'],"-",9)+1)));
      $req_data=$this->custModel->get_requests($date1,$date2,$_POST['REQ_TYPE'],$_POST['REQ_STATUS'],$_POST['CARD_ID'],$_POST['CUS_ID']);
      echo json_encode($req_data);
    }
  }

  public function get_notifications(){
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $date1=substr($_POST['REQ_DATE'],0,strpos($_POST['REQ_DATE']," ",0));
      $date2=substr($_POST['REQ_DATE'],((strpos($_POST['REQ_DATE'],"-",9)+1)));
      $noti_data=$this->custModel->get_notifications($date1,$date2,$_POST['REQ_TYPE'],$_POST['NOTI_STATUS']);
      echo json_encode($noti_data);
    }
  }


  public function get_card_data(){
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
     
      $carddata=$this->custModel->get_card_data($_POST['CARD_ID']);
      echo json_encode($carddata);
    }
  }

  public function get_daily_care(){
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
     
      $dailycare=$this->custModel->get_daily_care($_POST['CARD_ID'],$_POST['CARE_STATUS']);
      echo json_encode($dailycare);
    }
  }


  
  public function singleUserData(){
    if($_POST){
 
   $userdata=$this->custModel->singleUserData($_POST['USER_ID']);
   
   echo json_encode($userdata);
    }
  }
  public function singlePayData(){
    if($_POST){
 
   $paydata=$this->custModel->singlePayData($_POST['REQ_ID']);
   
   echo json_encode($paydata);
    }
  }

  public function singleCusData(){
    if($_POST){
 
   $cusdata=$this->custModel->singleCusData($_POST['CUS_ID']);
   
   echo json_encode($cusdata);
    }
  }

  public function singleServiceData(){
    if($_POST){
 
   $servicedata=$this->custModel->singleServiceData($_POST['SERVICE_CODE']);
   
   echo json_encode($servicedata);
    }
  }

  public function getcusdata2(){
   
     
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $customerdata=$this->custModel->getcusdata2($_POST['customername'],$_POST['customerid']);
      echo json_encode($customerdata);
    }
    
  }
  public function addcustomerdata(){
    
 
    if($_POST){
  
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $CUS_ID='CUS';

  
  $customer=[
  "CUS_ID"=>$CUS_ID,
  "USER_ID"=>$_SESSION['user_id'],
  "CUS_NAME"=>strtoupper($_POST['CUSTOMERNAME']),
  "SEX"=>$_POST['SEX'],
  "AGE"=>$_POST['AGE'],
  "PHONENO"=>$_POST['PHONENO'],
  "REGION"=>$_POST['REGION'],
  "CITY"=>strtoupper($_POST['CUSTOMERCITY']),
  "NATIONALITY"=>$_POST['NATIONALITY'],
  
  ];
  
  $output = array('success' => false, 'messages' => array());

  
  if($this->custModel->addcustomer($customer) ) {
      $output['success'] = true;
      $output['messages'] = 'Successfully Added Customer';
  
  } else {
    $output['success'] = false;
    $output['messages'] = 'Error while adding Customer';
  }
    }
  echo json_encode($output);
  }


  public function addpaymentdata(){
    
 
    if($_POST){
  
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $CUS_ID='CUS0';

  
  $customer=[
  "CUS_ID"=>$CUS_ID,
  "USER_ID"=>$_SESSION['user_id'],
  "CUS_NAME"=>strtoupper($_POST['add_CUSTOMERNAME']),
  "SEX"=>$_POST['add_SEX'],
  "AGE"=>$_POST['add_AGE'],
  "PHONENO"=>$_POST['add_PHONENO'],
  "REGION"=>$_POST['add_REGION'],
  "CITY"=>strtoupper($_POST['add_CUSTOMERCITY']),
  "NATIONALITY"=>$_POST['add_NATIONALITY'],
  "SERVICE_CODE"=>$_POST['add_SERVICE'],
  "CARD_TYPE"=>$_POST['W_CARD_PR_TYPE'],
  
  ];
  
  $output = array('success' => false, 'messages' => array());

  
  if($this->custModel->addpaymentdata($customer) ) {
      $output['success'] = true;
      $output['messages'] = 'Successfully Added Customer';
  
  } else {
    $output['success'] = false;
    $output['messages'] = 'Error while adding Customer';
  }
    }
  echo json_encode($output);
  }

  public function add_gen_data(){
    if($_POST){
  
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $M_SER_CODE;
      if( isset($_POST['M_SER_CODE']) )
      {
        $M_SER_CODE=$_POST['M_SER_CODE'];
      }
      else
      $M_SER_CODE=null;
  $patient=[
    "REQ_ID"=>$_POST['REQ_ID'],
    "CUS_ID"=>trim($_POST['CUS_ID']),
    "CARD_NO"=>$_POST['CARD_NO'],
    "MAJOR_SER_CODE"=>$_POST['MAJOR_SER_CODE'],
    "M_SER_CODE"=>$M_SER_CODE,
  "USER_ID"=>$_SESSION['user_id'],
  "CUS_NAME"=>strtoupper($_POST['CUS_NAME']),
  "TEMPRATURE"=>$_POST['add_temp'],
  "WEIGHT"=>$_POST['add_weight'],
  "HEIGHT"=>strtoupper($_POST['add_height']),
  "SYSTOLICBP"=>$_POST['add_SYSTOLICBP'],
  "DIASTOLICBP"=>$_POST['add_DIASTOLICBP'],
  "PULSE_RATE"=>$_POST['add_PULSE_RATE'],
  "REQ_TYPE"=>$_POST['REQ_TYPE'],
  ];
  
  $output = array('success' => false, 'messages' => array());

  
  if($this->custModel->add_gen_data($patient) ) {
      $output['success'] = true;
      $output['messages'] = 'Successfully Added Customer';
  
  } else {
    $output['success'] = false;
    $output['messages'] = 'Error while adding Customer';
  }
    }
  echo json_encode($output);
  }


  public function add_mcare_data(){
    if($_POST){
  
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
  $mcare=[
    "CUS_ID"=>trim($_POST['CUS_ID']),
    "CARD_NO"=>$_POST['CARD_NO'],
    "BED_ID"=>$_POST['BED_ID'],
  "REQUIRE_TREAT"=>$_POST['REQUIRE_TREAT'],
  "DOSE_LIST"=>$_POST['DOSE_LIST'],
  "CARE_START_TIME"=>$_POST['CARE_START_TIME'],
  "DOSE_COUNT_SINGLE"=>$_POST['DOSE_COUNT_SINGLE'],
  "DOSE_COUNT"=>$_POST['DOSE_COUNT'],
  "HOUR_DIFF"=>$_POST['HOUR_DIFF'],

  ];
  
  $output = array('success' => false, 'messages' => array());

  
  if($this->custModel->add_mcare_data($mcare) ) {
      $output['success'] = true;
      $output['messages'] = 'Successfully Added Care Detail';
  
  } else {
    $output['success'] = false;
    $output['messages'] = 'Error while adding Care Detail';
  }
    }
  echo json_encode($output);
  }



  public function resend_customer(){
   
            if($_POST){
              
              $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $output = array('success' => false, 'messages' => array());
        $check_userinfo=$this->custModel->resend($_POST['CUS_ID'],$_POST['CUS_NAME']) ;


        if($check_userinfo ) {

        $output['success'] = true;
        $output['messages'] = 'Request Successfully sent';


        } else {
        $output['success'] = false;
        $output['messages'] = 'Error while sending request Successfully';
        }
        echo json_encode($output);
        }
    }

    public function getCardData(){
     
      echo json_encode($this->custModel->getCardData($_POST['CUS_ID']));
      
    }
    public function getFlowData(){
     
      echo json_encode($this->custModel->getFlowData($_POST['CARD_NO']));
      
    }

    public function pro_card_payment(){
    
 
      if($_POST){
    
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
    $paymentData=[
      "REQ_ID"=>$_POST['REQ_ID'],
    "CARD_TYPE"=>$_POST['CARD_TYPE'],
    "CUS_ID"=>trim($_POST['CUS_ID']),
    "MAJOR_SER_CODE"=>$_POST['MAJOR_SER_CODE'],
    "CUS_NAME"=>$_POST['CUS_NAME'],
    ];
     
    $output = array('success' => false, 'messages' => array());
    $singleProcess=$this->custModel->pro_card_payment($paymentData) ;
    
    if($singleProcess ) {
        $output['success'] = true;
        $output['messages'] = 'Successfully Processed Payment';
    
    } else {
      $output['success'] = false;
      $output['messages'] = 'Error while Processing payment';
    }
    echo json_encode($output);
    }
    }

    public function pro_req_payment(){
    
 
      if($_POST){
    
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                  
    $paymentData=[
      "REQ_ID"=>$_POST['REQ_ID'],
    "CUS_ID"=>trim($_POST['CUS_ID']),
    "MAJOR_SER_CODE"=>$_POST['MAJOR_SER_CODE'],
    "CUS_NAME"=>$_POST['CUS_NAME'],
    "SERVICE_PRICE"=>$_POST['SERVICE_PRICE'],
    "CARD_NO"=>$_POST['CARD_NO'],
    "REQ_TYPE"=>$_POST['REQ_TYPE'],
    "PAID_AMOUNT"=>$_POST['PAID_AMOUNT'],
    "PAYMENT_TYPE"=>$_POST['PAYMENT_TYPE'],
    ];
     
    $output = array('success' => false, 'messages' => array());
    $singleProcess=$this->custModel->pro_req_payment($paymentData) ;
    
    if($singleProcess ) {
        $output['success'] = true;
        $output['messages'] = 'Successfully Processed Payment';
    
    } else {
      $output['success'] = false;
      $output['messages'] = 'Error while Processing payment';
    }
    echo json_encode($output);
    }
    }

    public function update_status(){
          
      if($_POST){
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $requestinfo=[
    "REQ_ID"=>$_POST['REQ_ID'],
    "MAJOR_SER_CODE"=>$_POST['MAJOR_SER_CODE'],
    "REQ_PAYMENT_STATUS"=>$_POST['REQ_PAYMENT_STATUS']
    ];
    
    $output = array('success' => false, 'messages' => array());
    $update_status=$this->custModel->update_status($requestinfo) ;
    
    
    if($update_status ) {
    
    $output['success'] = true;
    $output['messages'] = 'YOU ARE CURRENTLY SERVING A CUSTOMER';
    
    
    } else {
    $output['success'] = false;
    $output['messages'] = 'ERROR OCCURED WHILE CHANGING STATUS UNABLE TO CONTINUE';
    }
    echo json_encode($output);
    }
    }

    public function change_status_all(){
          
      if($_POST){
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $requestinfo=[
    "REQ_ID"=>$_POST['REQ_ID'],
    "MAJOR_SER_CODE"=>$_POST['MAJOR_SER_CODE'],
    ];
    
    $output = array('success' => false, 'messages' => array());
    $change_status=$this->custModel->change_status_all($requestinfo) ;
    
    
    if($change_status ) {
    
    $output['success'] = true;
    $output['messages'] = 'YOU ARE CURRENTLY SERVING A CUSTOMER';
    
    
    } else {
    $output['success'] = false;
    $output['messages'] = 'ERROR OCCURED WHILE CHANGING STATUS UNABLE TO CONTINUE';
    }
    echo json_encode($output);
    }
    }

    public function complete_care(){
          
      if($_POST){
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
 
    $output = array('success' => false, 'messages' => array());
    $change_status=$this->custModel->complete_care($_POST['ID']) ;
    
    
    if($change_status ) {
    
    $output['success'] = true;
    $output['messages'] = 'YOU COMPLETED  THE DAILY CARE.';
    
    
    } else {
    $output['success'] = false;
    $output['messages'] = 'ERROR OCCURED WHILE CHANGING STATUS UNABLE TO CONTINUE';
    }
    echo json_encode($output);
    }
    }

  

  }