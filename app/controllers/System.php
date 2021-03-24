<?php
  class System extends Controller{
    public $userdetails;
    public function __construct(){
     $this->systemModel = $this->model('sys');
     $this->filer = $this->filemethods('Fileoperations');
     $this->registerModel = $this->model('register');
    }

    
public function checkVisaExpiry(){
 
    $visaData=$this->systemModel->getAllVisaData();
    if($visaData !=false){
      for($i=0;$i<$visaData['data']['0']['size'];$i++){
     $this->systemModel->visaExcute($visaData['data'][$i]['fullname'], $visaData['data'][$i]['visaNo'],$visaData['data'][$i]['daysleft']);
     }
    }
}

public function checkPassExpiry(){
 
  $passData=$this->systemModel->getAllPassData();
  if($passData !=false){
    for($i=0;$i<$passData['data']['0']['size'];$i++){
   $this->systemModel->passExcute( $passData['data'][$i]['PassportNo'],$passData['data'][$i]['DaysLeft']);
   }
  }
}
public function reset(){
 
  $passData=$this->systemModel->reset();
 
}

	  
  }