<?php
class Fileoperations{
  
    public function Providepath(){
        if(isset($_POST['json'])){
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
  
  public function Uploadfile($compunique,$tempname,$filename){
  	$myNewFolderPath = FILEROOT.$compunique;
$ppp=$myNewFolderPath;

   if ( !file_exists($myNewFolderPath) ) {
    mkdir($myNewFolderPath, 0700);
    $myNewFolderPath.="/ForeignFiles";
    if ( !file_exists($myNewFolderPath) ) {
      mkdir($myNewFolderPath, 0700);
        // folder created
     } 
     else{
       
     }
   } else {
      // something went wrong
   }
	//uploading
	$upload_dir = FILEROOT.$compunique.'/';
					if(move_uploaded_file($tempname,$upload_dir.$filename)){
            return true;
          }
          else {
            return false;
          }
					
  
  }

  public function CreateFolder($folderid){
  	$myNewFolderPath = FILEROOT.$folderid;


   if ( !file_exists($myNewFolderPath) ) {
    mkdir($myNewFolderPath, 0700);
    
   
   } else {
  
   }
  
  }
  
  public function Givefilename($fileliteral,$fileext){
  //only give file a name
      $filename=$fileliteral;
      for($i=1;$i<=4;$i++){
        $filename=$filename.rand(0,9);
        }
       return $filename.=".".$fileext;
  
  }
  
  public function Givefilepath($foldername,$filename){
  //only give a file path to be possible to store to database
  $filepath=$foldername."/".$filename;
  return $filepath;
  }

  public function ReturnFile($filename,$modalname){
  $folder_dir = FILEROOT.$_SESSION['user_id'].'/';
    $file= $folder_dir.$filename;
    $imagetypes = array('jpeg', 'jpg', 'png');
    $fileExt = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    if(in_array($fileExt, $imagetypes) ){	
      $imageData = base64_encode(file_get_contents($file));
      $src = 'data: '.mime_content_type($file).';base64,'.$imageData;
      $show=[
        "type"=>"image",
          "small"=> '<a href="'.$src.'" type="button" data-toggle="modal" data-target="#'.$modalname.'"   class="img-modal img-responsive"   >
           <img src="'.$src.'" alt="" height="100" width="100" />
         </a>',
         "modal"=>'<img src="'.$src.'" alt="" class=" img-responsive modal-content" />'
      ];
      return  $show;
    }
    else{
      $show=[
        "type"=>"pdf",
          "file"=> '<a href="'.URLROOT.'/company/excuteFile?file='.$filename.'" type="button" target="_blank"   >View
         </a>',
        
      ];
      return  $show;
    }
  }

  public function ReturnLink($filename,$modalname){
    $folder_dir = FILEROOT.$_SESSION['user_id'].'/';
      $file= $folder_dir.$filename;
      $imagetypes = array('jpeg', 'jpg', 'png');
      $fileExt = strtolower(pathinfo($file,PATHINFO_EXTENSION));
      if(in_array($fileExt, $imagetypes) ){	
        $imageData = base64_encode(file_get_contents($file));
        $src = 'data: '.mime_content_type($file).';base64,'.$imageData;
        $show=[
          "type"=>"image",
           
           "modal"=>'<img src="'.$src.'" alt="" class=" img-responsive modal-content" />'
        ];
        return  $show;
      }
    
    }

    public function ReturnForeignFile($filename,$personId,$id){
      $folder_dir = FOREIGNFOLDER.$personId.'/';
        $file= $folder_dir.$filename;
        $imagetypes = array('jpeg', 'jpg', 'png');
        $fileExt = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if(in_array($fileExt, $imagetypes) ){	
          $imageData = base64_encode(file_get_contents($file));
          $src = 'data: '.mime_content_type($file).';base64,'.$imageData;
          $show=[ 
            "type"=>"image",
              "small"=> '<a type="button"  onclick="showFile(\''.$filename.'\',\''.$personId.'\')"  style="list-style-type:none" >
               <img src="'.$src.'" alt="" height="100" width="100" />
             </a>',
       
          ];
          return  $show;
        }
        else{
          $show=[
            "type"=>"pdf",
              "file"=> '<a href="'.URLROOT.'/company/excuteFile?file='.$filename.'" type="button" target="_blank"   >View
             </a>',
            
          ];
          return  $show;
        }
      }
	
	  public function ReturnForeignLink($filename,$personId,$modalname){
		  $folder_dir = FOREIGNFOLDER.$personId.'/';
      $file= $folder_dir.$filename;
      $imagetypes = array('jpeg', 'jpg', 'png');
      $fileExt = strtolower(pathinfo($file,PATHINFO_EXTENSION));
      if(in_array($fileExt, $imagetypes) ){	
        $imageData = base64_encode(file_get_contents($file));
        $src = 'data: '.mime_content_type($file).';base64,'.$imageData;
        $show=[
          "type"=>"image",
           
           "modal"=>'<img src="'.$src.'" alt="" class=" img-responsive modal-content" />'
        ];
        return  $show;
      }
    
    }

  public function UploadForeignfile($tempname,$filename){
	$upload_dir = FOREIGNFOLDER.'/';
					if(move_uploaded_file($tempname,$upload_dir.$filename)){
            return true;
          }
          else {
            return false;
          }
					
  
  }

  public function getMRZ($sharedfolder){
    $filepath=FILEROOT.$sharedfolder."/".FILENAME;
    if (file_exists($filepath)) {
  
      $file = file_get_contents($filepath);
      
      $docType= preg_replace("([<]+)","",substr($file,0,1));
      if($docType == "P"){
        $country=preg_replace("([<]+)","",substr($file,2,3));
        $surname=preg_replace("([<]+)","",substr($file,5,strpos($file,"<",5)-5));
        $givenname1=preg_replace("([<]+)","",substr($file,strpos($file,"<",5)+2,strpos($file,"<",strpos($file,"<",5)+2)-(strpos($file,"<",5)+2)));
        $givenname2 = preg_replace("([<]+)","",substr($file,((strpos($file,"<",5)+2) + (strlen($givenname1)))+1,strpos($file,"<",((strpos($file,"<",5)+2) + (strlen($givenname1)))+1) - ((strpos($file,"<",5)+2) + (strlen($givenname1))+1)));
        $givenname= $givenname1 ." ". $givenname2;
        $docnum= preg_replace("([<]+)","",substr($file,42,9));
        $nationality= preg_replace("([<]+)","",substr($file,52,3));
        $dateofbirth= preg_replace("([<]+)","",substr($file,55,6));
        $year=substr($dateofbirth,0,2);
        $month=substr($dateofbirth,2,2);
        $day=substr($dateofbirth,4,2);
        //$monthIndex=array("JAN"=>"01","FEB"=>"02","MAR"=>"03","APR"=>"04","MAY"=>"05","jUN"=>"06","JUL"=>"07","AUG"=>"08","SEP"=>"09","OCT"=>"10","NOV"=>"11","DEC"=>"12");
        $monthIndex=array("01"=>"JAN","02"=>"FEB","03"=>"MAR","04"=>"APR","05"=>"MAY","06"=>"jUN","07"=>"JUL","08"=>"AUG","09"=>"SEP","10"=>"OCT","11"=>"NOV","12"=>"DEC");
        foreach($monthIndex as $x=>$x_value) {
            if($x==$month){
            $month=$x_value;
            break;
            }
          }
        
        $dateofbirth= $day . " " . $month . " " . $year;
    
        $sex= preg_replace("([<]+)","",substr($file,62,1));
        $dateofexpiry= preg_replace("([<]+)","",substr($file,63,6));
        $dyear=substr($dateofexpiry,0,2);
        $dmonth=substr($dateofexpiry,2,2);
        $dday=substr($dateofexpiry,4,2);
        $dateofexpiry = $dday . "/" . $dmonth . "/" . $dyear;
        $mrzData = array(
          'type' => 'MRZ',
          'success' => true,
          'issue_state' => $country,
          'surname' => $surname,
          'givenname' => $givenname,
          'documentnumber' => $docnum,
          'nationality' => $nationality,
          'dateofbirth' => $dateofbirth,
          'sex' => $sex,
          'expirydate' => $dateofexpiry
        );
        return $mrzData;
      }
      else{
            $returnData = array(
                'type' => 'ERROR',
                'success' => false,
                'messages' => 'Please Insert Correct Document Type. Passports Only Allowed'

            );
           return $returnData;
      }
      
  } else {
    $returnData = array(
      'type' => 'ERROR',
      'success' => false,
      'messages' => 'FILE NOT FOUND PLEASE SCAN PASSPORT'

  );
  return $returnData;
  }

    
  }
   
}
?>