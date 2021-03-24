<?php
//$jsonobj=json_decode($_POST['testforms'],true);
 class Jsonvalidate extends Controller {
    public function __construct(){
     
        $this->dater = $this->datemethods('DateOperations');
      }
 //var $jsonobj = array("forminputs"=>array("size"=>1,"mainerror"=>false,"0"=>"comp_name","1"=>"comp_sex"),"comp_name"=>array( "haserror"=>false,"formliteral"=>"Company Name","inputvalue"=>"ghhgghh","inputtype"=>"string","errorname"=>"error_comp_name","errorvalue"=>null),"comp_sex"=>array("haserror"=>false,"formliteral"=>"Company Sex","inputvalue"=>"dfdgdf","inputtype"=>"string","errorname"=>"error_comp_name","errorvalue"=>null));
 var $jsonobj;
public function maindistributer( $takejson){
$this->jsonobj=$takejson;

    for($i=0;$i<=$this->jsonobj['forminputs']['size'];$i++){
   
        //if string
       if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='string'){
        //$letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
            $this->StringValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='number'){
            //$letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
            $this->NumberValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='email'){
            //$letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
            $this->EmailValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='mobile'){
           // $letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
            $this->MobileNumberValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='stringnum'){
           // $letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
            $this->StringNumValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='radio'){
            //$letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
        $this->RadioValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='select'){
            //$letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
        $this->SelectValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='check'){
            //$letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
            $this->CheckValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='date'){
            //$letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
            $this->DateValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='dategreater'){
            //$letsreturn=$letsreturn.$this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype'];
            $this->DateGreaterValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='file' ){
            $this->Filevalidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='password'){
            $this->PasswordValidate($this->jsonobj['forminputs'][$i]);
        }
        else if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['inputtype']=='passwordmatch'){
            $this->PasswordMatchValidate($this->jsonobj[$this->jsonobj['forminputs'][$i]]['matchto'],$this->jsonobj['forminputs'][$i]);
        }
  
        }
        $haserror=false;
        for($i=0;$i<=$this->jsonobj['forminputs']['size'];$i++){
            if($this->jsonobj[$this->jsonobj['forminputs'][$i]]['haserror']==true){
              
                    $haserror=true;
                    break;
                }

        }
        if($haserror){
            $this->jsonobj['forminputs']['mainerror']=true;
        }
      
            return $this->jsonobj;
            //echo json_encode($output);
}
public function StringValidate($data){
        
    if(empty($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
   else {
      
        if (!preg_match("/^[a-zA-Z ]*$/",$this->test_input($_POST[$data]))) {
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  valid ".$this->jsonobj[$data]['formliteral']." only letters allowed";
            
       }
       else{
        $this->jsonobj[$data]['haserror']=false;
    $this->jsonobj[$data]['errorvalue']=null;
  
       }
    
}
}
public function NumberValidate($data){
    if(empty($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
   else {
      
        if (!preg_match("/[0-9]/",$this->test_input($_POST[$data]))) {
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  valid ".$this->jsonobj[$data]['formliteral']." only numbers allowed";
            
       }
       else{
        $this->jsonobj[$data]['haserror']=false;
        $this->jsonobj[$data]['errorvalue']=null;
     
       }
    
}
}

public function EmailValidate($data){
    if(empty($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
   else {
      
        if (!filter_var($this->test_input($_POST[$data]), FILTER_VALIDATE_EMAIL)) {
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  valid ".$this->jsonobj[$data]['formliteral'];
         
       }
       else{
        $this->jsonobj[$data]['haserror']=false;
        $this->jsonobj[$data]['errorvalue']=null;
       
       }
    
}
}

public function MobileNumberValidate($data){
    if(empty($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
   else {
      
        if (!preg_match("/^\(?([0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/",$this->test_input($_POST[$data]))) {
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  valid ".$this->jsonobj[$data]['formliteral'];
       
       }
       else{
        $this->jsonobj[$data]['haserror']=false;
    $this->jsonobj[$data]['errorvalue']=null;

       }
    
}
}

public function Filevalidate($data){
    $valid_extensions = array('jpeg', 'jpg', 'png','pdf'); // valid extensions
    $valid_mime_types=array('image/jpeg','image/png','image/tiff','application/pdf');//valid mime types 
        $imgFile = $_FILES[$data]['name'];
	
        
        if(!empty($imgFile)){
    
		$tmp_dir = $_FILES[$data]['tmp_name'];
        $imgSize = $_FILES[$data]['size'];
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
            $imgmime= $this->getMIMEType($tmp_dir);
				// allow valid image file formats
                if(in_array($imgmime, $valid_mime_types) ){
                    //check mime type
                   
                    if(in_array($imgExt, $valid_extensions) ){			
                    // Check file size '5MB'
                    if($imgSize < 5000000 )	{
                        
                        $this->jsonobj[$data]['haserror']=false;
                    $this->jsonobj[$data]['errorvalue']=null;
                    }
                    else{
                        $this->jsonobj[$data]['haserror']=true;
                        $this->jsonobj[$data]['errorvalue']="please upload a file below 5MB ";
                    }
                }
                else{
                    $this->jsonobj[$data]['haserror']=true;
                    $this->jsonobj[$data]['errorvalue']="please upload a valid  ".$this->jsonobj[$data]['formliteral'];
                }
                
                }
                else{
                    $this->jsonobj[$data]['haserror']=true;
                    $this->jsonobj[$data]['errorvalue']="please upload a valid mime ".$this->jsonobj[$data]['formliteral'];
                
                }
        }
        else{
            
                if( $this->jsonobj[$data]['mandatory']==true){
                    $this->jsonobj[$data]['haserror']=true;
                    $this->jsonobj[$data]['errorvalue']="please upload ".$this->jsonobj[$data]['formliteral'];
                }
                
            
            
        }
        
    
}

function getMIMEType($filename){
    try {
        
$finfo = new finfo;
$fileinfo = $finfo->file($filename, FILEINFO_MIME_TYPE);
        return $fileinfo;
    } catch (Exception $e) {
        $fileinfo="invalid/invalid";
        return $fileinfo;
    }
   }

public function StringNumValidate($data){
    if(empty($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
   else {
      
        if (!preg_match("/^[a-zA-Z0-9]/",$this->test_input($_POST[$data]))) {
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  valid ".$this->jsonobj[$data]['formliteral'];
           
       }
       else{
        $this->jsonobj[$data]['haserror']=false;
        $this->jsonobj[$data]['errorvalue']=null;
      
       }
    
}
}

public function RadioValidate($data){
    if(!isset($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
    else {
        
     
        $this->jsonobj[$data]['haserror']=false;
        $this->jsonobj[$data]['errorvalue']=null;
       
        
        
    }
}

public function SelectValidate($data){
    if(empty($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
    else {
        
     
        $this->jsonobj[$data]['haserror']=false;
        $this->jsonobj[$data]['errorvalue']=null;
       
        
        
    }
}

public function DateValidate($data){
    if(empty($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please select  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
    else {
        
     
        $this->jsonobj[$data]['haserror']=false;
        $this->jsonobj[$data]['errorvalue']=null;
       
        
        
    }
}
public function DateGreaterValidate($data){
    if(empty($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please select  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
    else {
        
        $date=new DateTime(date("y-m-d"));
        $date2=  new DateTime($_POST[$data]);
        $diff = date_diff( $date2, $date);
        $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
        if($this->dater->greaterDays($_POST[$data],$this->jsonobj[$data]['datevalue'])){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="The ".$this->jsonobj[$data]['formliteral']." "."is invalid, please make sure it is greater than 1 year";
        }
        else{
            $this->jsonobj[$data]['haserror']=false;
            $this->jsonobj[$data]['errorvalue']=null;
        }
     
       
        
        
    }
}
public function CheckValidate($data){
    if(!isset($_POST[$data])){
        if( $this->jsonobj[$data]['mandatory']==true){
            $this->jsonobj[$data]['haserror']=true;
            $this->jsonobj[$data]['errorvalue']="please insert  ".$this->jsonobj[$data]['formliteral'];
        }
        
    }
   else { 
    
    $this->jsonobj[$data]['haserror']=false;
    $this->jsonobj[$data]['errorvalue']=null;

}
}
public function PasswordValidate($data){
    if(!empty($_POST[$data])){
        $status=true;
        if (strlen($_POST[$data]) < 8){
            $status=false;
        $this->jsonobj[$data]['haserror']=true;
    $this->jsonobj[$data]['errorvalue']="Your password should not be less than 8 characters.";
        }
    if (!preg_match('/\d/', $_POST[$data])){
        $status=false;
    $this->jsonobj[$data]['haserror']=true;
    $this->jsonobj[$data]['errorvalue']="Your password should contain atleast one digit.";
    }
    if (!preg_match('/[^A-Za-z0-9]/', $_POST[$data])){
        $status=false;
    $this->jsonobj[$data]['haserror']=true;
    $this->jsonobj[$data]['errorvalue']="Your password should contain atleast one of the following special characters ('~,@,!,#,*').";
    }   
    if($status){
        $this->jsonobj[$data]['haserror']=false;
        $this->jsonobj[$data]['errorvalue']=null;
    }
    }
   else {
        $this->jsonobj[$data]['haserror']=true;
        $this->jsonobj[$data]['errorvalue']="please input  ".$this->jsonobj[$data]['formliteral'];
    
}

    
}
public function PasswordMatchValidate($main,$repeat){
    if(!empty($_POST[$repeat])){
        if($_POST[$main]!=$_POST[$repeat]){
            $this->jsonobj[$repeat]['haserror']=true;
            $this->jsonobj[$repeat]['errorvalue']="Password must match.";
        }
        else{
            $this->jsonobj[$repeat]['haserror']=false;
            $this->jsonobj[$repeat]['errorvalue']=null;
        }
       
        
    }
    else{
      
            $this->jsonobj[$repeat]['haserror']=true;
            $this->jsonobj[$repeat]['errorvalue']="Password retype your password.";
        
    }
  
}

public function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }


}



    
?>