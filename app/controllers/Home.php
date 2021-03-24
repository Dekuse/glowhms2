<?php
  class Home extends Controller{
    public function __construct(){
     $this->registerModel = $this->model('register');
     $this->filer = $this->filemethods('Fileoperations');
    }

    public function index(){
      $data=[];
      $this->view('Home/index', $data);
    }
    public function login(){
    
      
      if($_POST){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [       
          'user' => trim($_POST['user']),
          'pass' => trim($_POST['pass']),        
          'email_err' => '',
          'password_err' => '', 
          'alert'=>''      
        ];

        // Check for email
        if(empty($data['user'])){
          $data['email_err'] = 'Please enter Username.';
        }
        if(empty($data['pass'])){
          $data['password_err'] = 'Please enter Password.';
        }

        if(empty($data['email_err']) && empty($data['password_err'])){

          
             // Check and set logged in user
          $loggedInUser = $this->registerModel->login($data['user'], $data['pass']);

          if($loggedInUser){
            // User Authenticated!

            $address= get_ip_address();
           
           
            if($loggedInUser->USER_TYPE =="ADMIN"){
              $admin= "user";
              $admindata = $this->registerModel->getAdminInput($admin,$loggedInUser->USER_ID);
              $this->registerModel->addLoginLog($address,$loggedInUser->USER_ID,$loggedInUser->USER_TYPE);
              createAdminSession($loggedInUser);
              header('location: '.URLROOT.'/administrator/bed');
            }
            else{
              $admin= "user";
              $userdata = $this->registerModel->getAdminInput($admin,$loggedInUser->USER_ID);
              $this->registerModel->addLoginLog($address,$loggedInUser->USER_ID,$loggedInUser->USER_TYPE);
              createUserSession($loggedInUser);
              header('location: '.URLROOT.'/customer/registercu');
            }
           
           
          } else {
            $data['alert'] = "<div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
            <h4><i class='icon fa fa-ban'></i> Alert!</h4>
            Error in your Username or Password.
          </div>";
            // Load View
            $this->view('Home/login', $data);
          }
        
         
           
        } else {
          // Load View
          $this->view('Home/login', $data);
        }
        $this->view('Home/login', $data);
      }
      else{
        
        $data = [
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',
          'alert'=>''
        ];
       $this->view('home/login', $data);
      }
      // Load about view
      
    }

	 
	  
	 

  
	  
  }