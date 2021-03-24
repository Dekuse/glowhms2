<?php
  class Functions extends Controller{
    public $userdetails;
    public function __construct(){
      if(!isset($_SESSION['user_id']) || userSessionX() ){
        logout();
      }
     $this->funcModel = $this->model('func');
     $this->custModel = $this->model('cust');
     $this->filer = $this->filemethods('Fileoperations');
     $this->userdetails=$this->custModel->getUserInfo();
     $this->registerModel = $this->model('register');
    }

    public function logOut(){
      logout();
  }
 
  public function service(){
    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"SERVICE"
    ];
    $this->view('function/service', $data);
  }

  public function bed(){
    $data = [
      'username' => $this->userdetails->FULL_NAME,
      'email'=>$this->userdetails->EMAIL,
      'pagename'=>"BED"
    ];
    $this->view('function/bed', $data);
  }


  public function getmajorservice2(){
    echo json_encode($this->funcModel->getmajorservice2());
  }
  public function getservice(){
    echo json_encode($this->funcModel->getservice());
  }

  public function getbed_data(){
   
     
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
     
      $customerdata=$this->funcModel->getbed_data($_POST['CUSTOMER_NAME'],$_POST['CUSTOMER_ID']);
      echo json_encode($customerdata);
    }
    
  }

  public function get_bedstatus(){
   
     
    if($_POST){
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
     
      $customerdata=$this->funcModel->get_bedstatus($_POST['BED_STATUS']);
      echo json_encode($customerdata);
    }
    
  }
    

    

    

  }