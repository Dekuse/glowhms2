<?php
 ini_set('session.gc_maxlifetime',54000);  
 ini_set('session.gc_probability',1);
 ini_set('session.gc_divisor',1); 
session_start();


function flash($name = '', $message = '', $class = 'alert alert-success'){
  if(!empty($name)){
  
    if(!empty($message) && empty($_SESSION[$name])){
      if(!empty( $_SESSION[$name])){
          unset( $_SESSION[$name]);
      }
      if(!empty( $_SESSION[$name.'_class'])){
          unset( $_SESSION[$name.'_class']);
      }
      $_SESSION[$name] = $message;
      $_SESSION[$name.'_class'] = $class;
    }
 
    elseif(!empty($_SESSION[$name]) && empty($message)){
      $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : 'success';
      echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
      unset($_SESSION[$name]);
      unset($_SESSION[$name.'_class']);
    }
  }
}

 
function createAdminSession($user){
  $_SESSION['adminLimit'] = strtotime("now");
    $_SESSION['admin_id'] = $user->USER_ID;
    $_SESSION['user_type'] = $user->USER_TYPE; 
    
  
  }
  function createUserSession($user){
    $_SESSION['userLimit'] = strtotime("now");
    $_SESSION['user_id'] = $user->USER_ID;
    $_SESSION['user_type'] = $user->USER_TYPE; 
  }
  function createDepartSession($user,$place,$address){
    $_SESSION['departLimit'] = strtotime("now");
    $_SESSION['depart_id'] = $user->OraccUser;
    $_SESSION['user_type'] = $user->UserType; 
    $_SESSION['user_place'] = $place;
    $_SESSION['user_address'] = $address;
  
  }

   function Departlogout(){
    unset($_SESSION['depart_id']);
    unset($_SESSION['user_type']);
    unset($_SESSION['user_place']);
    session_destroy();
    redirect('home/login');
  }
  function logout(){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    unset($_SESSION['user_place']);
    session_destroy();
    redirect('home/login');
  }
  function Adminlogout(){
    unset($_SESSION['adminLimit']);
    unset($_SESSION['admin_id']);
    unset($_SESSION['user_type']);
    session_destroy();
    redirect('home/login');
  }


function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
      return true;
    } else {
      return false;
    }
  }

  function adminSessionX(){ 
    $logLength = 900; 
    $ctime = strtotime("now"); 
        if(((strtotime("now") - $_SESSION['adminLimit']) > $logLength) ){ 
           return true; 
        }else{ 
            $_SESSION['adminLimit'] = $ctime; 
        } 
} 

function userSessionX(){ 
  $logLength = 900; 
  $ctime = strtotime("now"); 
      if(((strtotime("now") - $_SESSION['userLimit']) > $logLength) ){ 
         return true; 
      }else{ 
          $_SESSION['userLimit'] = $ctime; 
      } 
}

function departSessionX(){ 
  $logLength = 900; 
  $ctime = strtotime("now"); 
      if(((strtotime("now") - $_SESSION['departLimit']) > $logLength) ){ 
         return true; 
      }else{ 
          $_SESSION['departLimit'] = $ctime; 
      } 
}