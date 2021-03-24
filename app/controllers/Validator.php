<?php
  class Validator extends Controller{
    public function __construct(){
    $this->validaters= $this->valid("Jsonvalidate");
    }

    // Load Homepage
    /**
 *
 */public function Jsonvalidate(){
      if($_POST['json']){
        $jsonobj=json_decode($_POST['json'],true);
      
        $resopnse=$this->validaters->maindistributer($jsonobj);
         echo json_encode($resopnse);
      }
      else{
        $data = [
          'version' => '1.0.0'
        ];
        $this->view('home/register', $data);
      }
      
      
  
    

    }

    
	  
  }