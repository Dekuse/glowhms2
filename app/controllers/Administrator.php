<?php
  class Administrator extends Controller{
    public $userdetails;
    public function __construct(){
      if(!isset($_SESSION['admin_id']) || adminSessionX() ){
        Adminlogout();
      }
     $this->adminModel = $this->model('admin');
     $this->filer = $this->filemethods('Fileoperations');
     $this->userdetails=$this->adminModel->getUserInfo();
     $this->registerModel = $this->model('register');
    }

    public function logOut(){
      Adminlogout();
  }
 
    

    public function bed(){
  
      $majorbedtable=$this->adminModel->getmajorbeddata2();
      
   
      $data = [
        'username' => $this->userdetails->FULL_NAME,
        'email'=>$this->userdetails->EMAIL,
        'majorbed'=>$majorbedtable,
        'pagename'=>"BED"
      ];
      $this->view('administrator/bed', $data);
    }


    public function user_role(){
  
      $nation=$this->registerModel->getInput('lu_nation'); 
      $majoractordata=$this->registerModel->getInput('lu_actor_major');
      $profession=$this->adminModel->getactorlist();
      $userslist=$this->adminModel->getuserlist();
      $majorserdata=$this->adminModel->getmajorservice();
   
      $data = [
        'username' => $this->userdetails->FULL_NAME,
        'email'=>$this->userdetails->EMAIL,
        'majoractor'=>$majoractordata,
        'nation'=>$nation,
        'prof'=>$profession,
        'users'=>$userslist,
        'majorservice'=>$majorserdata,
        'pagename'=>"USERS & ROLES"
      ];
      $this->view('administrator/urole', $data);
    }

    public function card(){
      $data = [
        'username' => $this->userdetails->FULL_NAME,
        'email'=>$this->userdetails->EMAIL,
        
        'pagename'=>"CARD"
      ];
      $this->view('administrator/card', $data);
    }

    public function actor(){
      $majoractordata=$this->adminModel->getmajoractor();
      $data = [
        'username' => $this->userdetails->FULL_NAME,
        'email'=>$this->userdetails->EMAIL,
        'majoractor'=>$majoractordata,
        'pagename'=>"CARD"
      ];
      $this->view('administrator/actor', $data);
    }

    public function service(){
      $majorserdata=$this->adminModel->getmajorservice();
      $data = [
        'username' => $this->userdetails->FULL_NAME,
        'email'=>$this->userdetails->EMAIL,
        'majorservice'=>$majorserdata,
        'pagename'=>"SERVICE"
      ];
      $this->view('administrator/service', $data);
    }

 
    public function getmajorbeddata(){
      echo json_encode($this->adminModel->getmajorbeddata());
    }

    public function getusersdata(){
      echo json_encode($this->adminModel->getusersdata());
    }

    public function getroledata(){
      echo json_encode($this->adminModel->getroledata());
    }

    public function getservice(){
      echo json_encode($this->adminModel->getservice());
    }


    public function getcardpdata(){
      echo json_encode($this->adminModel->getcardpdata());
    }
    public function getactordata(){
      echo json_encode($this->adminModel->getactordata());
    }



    public function getbeddata(){
      echo json_encode($this->adminModel->getbeddata());
    }

    public function getmajorservice2(){
      echo json_encode($this->adminModel->getmajorservice2());
    }

    public function addmabeddata(){
    
 
      if($_POST){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $mabed_unique='MABED';
        
  
  for($i=1;$i<=4;$i++){
    $mabed_unique=$mabed_unique.rand(0,9);
    }
   
$mabed=[
  "MAJOR_BDR_CODE"=>$mabed_unique,
  "bdprice"=>$_POST['bdprice'],
  "bdaddress"=>$_POST['bdaddress'],
];
$output = array('success' => false, 'messages' => array());
$check_mabed=$this->adminModel->addmabed($mabed) ;
if($check_mabed ) {
  
    $output['success'] = true;
    $output['messages'] = 'Successfully added';
}
  else{
    $output['success'] = false;
	$output['messages'] = 'Error while adding major bed catagory';
  }

} else {
	$output['success'] = false;
	$output['messages'] = 'Error while adding information';
}
echo json_encode($output);
}

public function adduserdata(){
    
 
  if($_POST){

    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $user_unique='US';
    

for($i=1;$i<=4;$i++){
$user_unique=$user_unique.rand(0,9);
}

$user=[
"USER_ID"=>$user_unique,
"FULL_NAME"=>strtoupper($_POST['FULL_NAME']),
"SEX"=>$_POST['SEX'],
"PHONENO"=>$_POST['PHONENO'],
"CITY"=>strtoupper($_POST['CITY']),
"EMAIL"=>$_POST['EMAIL'],
"NATIONALITY"=>$_POST['NATIONALITY'],
"MAJOR_ACTOR"=>$_POST['MAJOR_ACTOR'],
"PROFESSION"=>$_POST['PROFESSION'],
];
$usersecured=[
  "USER_ID"=>$user_unique,
  "USER_TYPE"=>$_POST['MAJOR_ACTOR'],
  "USER_PASSWORD"=>'hms@1234'
  ];
$output = array('success' => false, 'messages' => array());
$check_user=$this->adminModel->adduser($user) ;
$userprotect=$this->adminModel->addusersecured($usersecured) ;
if($check_user ) {
  if($userprotect ){
    $output['success'] = true;
    $output['messages'] = 'Successfully Addes User';
  }
  else{
    $output['success'] = false;
	$output['messages'] = 'Error while adding information';
  }

} else {
	$output['success'] = false;
	$output['messages'] = 'Error while adding information';
}
  }
echo json_encode($output);
}

public function changeuserpass(){
    
 
  if($_POST){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      echo $_POST;
$usersecured=[
"firstPassword"=>$_POST['newPassword'],
"ID"=>$_POST['ID'],
];
    
$output = array('success' => false, 'messages' => array());
$check_userpass=$this->adminModel->changeuserpass($usersecured) ;

if($check_userpass ) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Updated Password';

} else {
  $output['success'] = false;
  $output['messages'] = 'Error while updating information';
}
echo json_encode($output);
}
}


public function addservicedata(){
    
 
  if($_POST){

    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $ser_unique='SR';
    

for($i=1;$i<=3;$i++){
$ser_unique=$ser_unique.rand(0,9);
}

$ser=[
"SERVICE_CODE"=>$ser_unique,
"SERVICE_NAME"=>strtoupper($_POST['SERVICE_NAME']),
"MAJOR_SER_CODE"=>$_POST['MAJOR_SER_CODE'],
"DESCI"=>strtoupper($_POST['DESCI']),
"PRICE"=>$_POST['PRICE'],
];
$output = array('success' => false, 'messages' => array());
$check_ser=$this->adminModel->addservicedata($ser) ;
if($check_ser ) {

$output['success'] = true;
$output['messages'] = 'Successfully added';
}
else{
$output['success'] = false;
$output['messages'] = 'Error while adding major bed catagory';
}

} else {
$output['success'] = false;
$output['messages'] = 'Error while adding information';
}
echo json_encode($output);
}

public function addcardpr(){
    
 
  if($_POST){

    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $cardp_unique='C';
    

for($i=1;$i<=2;$i++){
$cardp_unique=$cardp_unique.rand(0,9);
}

$card=[
"CARD_PR_TYPE"=>$cardp_unique,
"CARD_PR_DES"=>strtoupper($_POST['CARD_PR_DES']),
"CARD_PR_PRICE"=>$_POST['CARD_PR_PRICE'],
];
$output = array('success' => false, 'messages' => array());
$check_cardp=$this->adminModel->addcardp($card) ;
if($check_cardp ) {

$output['success'] = true;
$output['messages'] = 'Successfully added';
}
else{
$output['success'] = false;
$output['messages'] = 'Error while adding ';
}

} else {
$output['success'] = false;
$output['messages'] = 'Error while adding information';
}
echo json_encode($output);
}

public function addrole(){
    

  if($_POST){

    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $single_major_ser=$this->adminModel->getsinglemser($_POST['role_MAJOR_ACTOR']);

$role=[
"USER_ID"=>$_POST['userid'],
"MAJOR_SER_CODE"=>$_POST['role_MAJOR_ACTOR'],
"MAJOR_SER_NAME"=> $single_major_ser->SER_NAME,
];
$output = array('success' => false, 'messages' => array());
$check_cardp=$this->adminModel->addrole($role) ;
if($check_cardp ) {

$output['success'] = true;
$output['messages'] = 'Successfully added';
}
else{
$output['success'] = false;
$output['messages'] = 'Error while adding ';
}

} else {
$output['success'] = false;
$output['messages'] = 'Error while adding information';
}
echo json_encode($output);
}

public function addactor(){
    
 
  if($_POST){

    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $actor_unique='AC';
    

for($i=1;$i<=3;$i++){
$actor_unique=$actor_unique.rand(0,9);
}

$actor=[
"ACTOR_ID"=>$actor_unique,
"MAJOR_ACTOR"=>$_POST['MAJOR_ACTOR'],
"ACTOR_DESCI"=>strtoupper($_POST['ACTOR_DESCI']),
"ACTOR_NAME"=>strtoupper($_POST['ACTOR_NAME']),
];
$output = array('success' => false, 'messages' => array());
$check_cardp=$this->adminModel->addactor($actor) ;
if($check_cardp ) {

$output['success'] = true;
$output['messages'] = 'Successfully added';
}
else{
$output['success'] = false;
$output['messages'] = 'Error while adding ';
}

} else {
$output['success'] = false;
$output['messages'] = 'Error while adding information';
}
echo json_encode($output);
}

public function addbeddata(){
    
 
  if($_POST){

    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    $check_bed=false;
    
    for($i=1;$i<=$_POST['bedcount'];$i++){
     
      
        $bed=[
          "mabedtype"=>$_POST['mabedtype'],
          "bedcount"=>$_POST['bedcount'],
          ];
       
          $check_bed=$this->adminModel->addbed($bed) ;
     }



$output = array('success' => false, 'messages' => array());

if($check_bed ) {

$output['success'] = true;
$output['messages'] = 'Successfully added Bed';
}
else{
$output['success'] = false;
$output['messages'] = 'Error while adding Bed';
}

} else {
$output['success'] = false;
$output['messages'] = 'Error while adding information';
}
echo json_encode($output);
}

public function getbedunique(){
  $bed_unique='BED';
  for($i=1;$i<=3;$i++){
  $bed_unique=$bed_unique.rand(0,9);
  }
  
  return $bed_unique;
}

public function disablemabed(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$mabedinfo=[
"userId"=>$_POST['member_id'],
];


$output = array('success' => false, 'messages' => array());
$check_mabedinfo=$this->adminModel->disablemabed($mabedinfo) ;


if($check_mabedinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Disabled catagory';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Disabling catagory';
}
echo json_encode($output);
}
}

public function disableuser(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$userinfo=[
"ID"=>$_POST['ID'],
];


$output = array('success' => false, 'messages' => array());
$check_userinfo=$this->adminModel->disableuser($userinfo) ;


if($check_userinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Disabled catagory';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Disabling catagory';
}
echo json_encode($output);
}
}

public function enableuser(){
          
        if($_POST){
          $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $userinfo=[
      "ID"=>$_POST['ID'],
      ];


$output = array('success' => false, 'messages' => array());
$check_userinfo=$this->adminModel->enableuser($userinfo) ;


if($check_userinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Disabled User';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Disabling User';
}
echo json_encode($output);
}
}

public function disableser(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$serinfo=[
"ID"=>$_POST['member_id'],
];


$output = array('success' => false, 'messages' => array());
$check_serinfo=$this->adminModel->disableser($serinfo) ;


if($check_serinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Disabled Service';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Disabling Service';
}
echo json_encode($output);
}
}

public function enableser(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$serinfo=[
"ID"=>$_POST['member_id'],
];


$output = array('success' => false, 'messages' => array());
$check_serinfo=$this->adminModel->enableser($serinfo) ;


if($check_serinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Disabled Service';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Disabling Service';
}
echo json_encode($output);
}
}

public function disablecardp(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$cardpinfo=[
"ID"=>$_POST['member_id'],
];


$output = array('success' => false, 'messages' => array());
$check_cardpinfo=$this->adminModel->disablecardp($cardpinfo) ;


if($check_cardpinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Disabled Card Priority';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Disabling catagory';
}
echo json_encode($output);
}
}

public function disableactor(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$actorinfo=[
"ID"=>$_POST['member_id'],
];


$output = array('success' => false, 'messages' => array());
$check_cardpinfo=$this->adminModel->disableactor($actorinfo) ;


if($check_cardpinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Disabled Card Priority';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Disabling catagory';
}
echo json_encode($output);
}
}

public function enablecardp(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$cardpinfo=[
"ID"=>$_POST['member_id'],
];


$output = array('success' => false, 'messages' => array());
$check_cardpinfo=$this->adminModel->enablecardp($cardpinfo) ;


if($check_cardpinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Enabled Card Priority';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Enabling catagory';
}
echo json_encode($output);
}
}

public function enableactor(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$cardpinfo=[
"ID"=>$_POST['member_id'],
];


$output = array('success' => false, 'messages' => array());
$check_cardpinfo=$this->adminModel->enableactor($cardpinfo) ;


if($check_cardpinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Enabled Card Priority';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Enabling catagory';
}
echo json_encode($output);
}
}

public function disablebed(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$mabedinfo=[
"userId"=>$_POST['bedid'],
];


$output = array('success' => false, 'messages' => array());
$check_mabedinfo=$this->adminModel->disablebed($mabedinfo) ;


if($check_mabedinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Disabled Bed';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Disabling Bed';
}
echo json_encode($output);
}
}

public function enablemabed(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$mabedinfo=[
"userId"=>$_POST['member_id'],
];


$output = array('success' => false, 'messages' => array());
$check_mabedinfo=$this->adminModel->enablemabed($mabedinfo) ;


if($check_mabedinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Enabled catagory';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Enabling catagory';
}
echo json_encode($output);
}
}

public function enablebed(){
          
  if($_POST){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$bedinfo=[
"userId"=>$_POST['bedid'],
];


$output = array('success' => false, 'messages' => array());
$check_bedinfo=$this->adminModel->enablebed($bedinfo) ;


if($check_bedinfo ) {

$output['success'] = true;
$output['messages'] = 'Successfully Enabled Bed';


} else {
$output['success'] = false;
$output['messages'] = 'Error while Enabling Bed';
}
echo json_encode($output);
}
}

public function changeMabed(){
    
 
  if($_POST){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
$mabedChange=[
  "MAJOR_BDR_CODE"=>$_POST['MAJOR_BDR_CODE'],
"newprice"=>$_POST['newprice'],
"newaddress"=>strtoupper($_POST['newaddress']),
];
    
$output = array('success' => false, 'messages' => array());
$check_majorbed=$this->adminModel->changeMabed($mabedChange) ;

if($check_majorbed ) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Updated Major Bedroom Catagory';

} else {
  $output['success'] = false;
  $output['messages'] = 'Error while updating information';
}
echo json_encode($output);
}
}

public function changeuser(){
    
 
  if($_POST){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
        $userchange=[
          "ID"=>$_POST['ID'],
          "FULL_NAME"=>strtoupper($_POST['editFULL_NAME']),
          "SEX"=>$_POST['editSEX'],
          "PHONENO"=>$_POST['editPHONENO'],
          "CITY"=>strtoupper($_POST['editCITY']),
          "EMAIL"=>$_POST['editEMAIL'],
          "NATIONALITY"=>$_POST['editNATIONALITY'],
          "MAJOR_ACTOR"=>$_POST['editMAJOR_ACTOR'],
          "PROFESSION"=>$_POST['editPROFESSION'],
          ];
    
$output = array('success' => false, 'messages' => array());
$check_user=$this->adminModel->changeuser($userchange) ;

if($check_user ) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Updated User';

} else {
  $output['success'] = false;
  $output['messages'] = 'Error while updating information';
}
echo json_encode($output);
}
}

public function changeser(){
    
 
  if($_POST){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
$serChange=[
  "ID"=>$_POST['ID'],
  "SERVICE_NAME"=>strtoupper($_POST['edit_SERVICE_NAME']),
  "MAJOR_SER_CODE"=>$_POST['edit_MAJOR_SER_CODE'],
  "DESCI"=>strtoupper($_POST['edit_DESCI']),
  "PRICE"=>$_POST['edit_PRICE'],

];
    
$output = array('success' => false, 'messages' => array());
$check_ser=$this->adminModel->changeser($serChange) ;

if($check_ser ) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Updated Service Type';

} else {
  $output['success'] = false;
  $output['messages'] = 'Error while updating information';
}
echo json_encode($output);
}
}

public function changecardp(){
    
 
  if($_POST){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
$cardpChange=[
  "ID"=>$_POST['ID'],
"editCARD_PR_DES"=>strtoupper($_POST['editCARD_PR_DES']),
"editCARD_PR_PRICE"=>$_POST['editCARD_PR_PRICE'],
];
    
$output = array('success' => false, 'messages' => array());
$check_cardp=$this->adminModel->changecardp($cardpChange) ;

if($check_cardp ) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Updated Major Bedroom Catagory';

} else {
  $output['success'] = false;
  $output['messages'] = 'Error while updating information';
}
echo json_encode($output);
}
}

public function changeactor(){
  if($_POST){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
$actorChange=[
  "ID"=>$_POST['ID'],
"edit_MAJOR_ACTOR"=>$_POST['edit_MAJOR_ACTOR'],
"edit_ACTOR_NAME"=>strtoupper($_POST['edit_ACTOR_NAME']),
"edit_ACTOR_DESCI"=>strtoupper($_POST['edit_ACTOR_DESCI']),
];
    
$output = array('success' => false, 'messages' => array());
$check_actor=$this->adminModel->changeactor($actorChange) ;

if($check_actor ) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Updated Actor';

} else {
  $output['success'] = false;
  $output['messages'] = 'Error while updating information';
}
echo json_encode($output);
}
}



public function editbed(){
  if($_POST){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
        $bed=[
          "editbedtype"=>$_POST['editbedtype'],
          "id"=>$_POST['id'],
          ];

$output = array('success' => false, 'messages' => array());
$check_majorbed=$this->adminModel->editbed($bed) ;

if($check_majorbed ) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Updated Bedroom';

} else {
  $output['success'] = false;
  $output['messages'] = 'Error while updating information';
}
echo json_encode($output);
}
}


  }