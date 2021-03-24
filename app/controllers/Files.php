<?php
  class Files extends Controller {
    public function __construct(){
      $this->filer = $this->filemethods('Fileoperations');
    }

    // Load Homepage
    /**
 *
 */public function Providepath(){
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

public function Uploadfile(){


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
public function getMRZ(){
      echo json_encode($this->filer->getMRZ(),true);
}

    
	  
  }