<?php

  class Controller {
   
    public function model($model){
    
      require_once '../app/models/' . $model . '.php';
    
      return new $model();
    }

  
    public function view($url, $data = []){
     
      if(file_exists('../app/views/'.$url.'.php')){
       
        require_once '../app/views/'.$url.'.php';
      } else {
   
        die('View does not exist');
      }
    }

   
    public function valid($validate){
 
      require_once '../app/validators/' . $validate . '.php';
   
      return new $validate();
    }
    public function filemethods($filename){
    
      require_once '../app/files/' . $filename . '.php';
    
      return new $filename();
    }

    public function datemethods($filename){
  
      require_once '../app/date/' . $filename . '.php';
   
      return new $filename();
    }

  }