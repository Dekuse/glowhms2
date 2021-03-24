<?php
class DateOperations{
    public function getDays($final_date){
        $date=new DateTime(date("y-m-d"));
        $date2=  DateTime::createFromFormat('d-m-Y',$final_date);
        $diff = date_diff( $date2, $date);
        $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
        return $total;
    }

    public function greaterDays($final_date,$measure_date){
        $date=new DateTime(date("y-m-d"));
        $date2=  new DateTime($final_date);
        $diff = date_diff( $date2, $date);
        $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
        if($total<$measure_date){
            return true;
        }
        else {
            return false;
        }
    }
    public function returnFullDate($date){
                $db=$date;

                $fo=1;
                $fo=strpos($db,"-");

                $fo2=strpos($db,"-",$fo+1);
                $dt=substr($db,0,$fo);
                $dt2=substr($db,$fo+1,$fo2-1-$fo);

                $dt3=substr($db,$fo2+1);
                $dt3="20".$dt3;
                $db=$dt."-".$dt2."-".$dt3;
                return $db;
    }

    public function returnFullDateID($date){
        $db=$date;

        $fo=1;
        $fo=strpos($db,"/");

        $fo2=strpos($db,"/",$fo+1);
        $dt=substr($db,0,$fo);
        $dt2=substr($db,$fo+1,$fo2-1-$fo);

        $dt3=substr($db,$fo2+1);
        
        $db=$dt."-".$dt2."-".$dt3;
        return $db;
}

    public function checkExpiry($issue_date,$expirydate){
       $datetime2=DateTime::createFromFormat('d-m-Y', date('d-m-Y'));
        $datetime1 = DateTime::createFromFormat('d-m-Y',$expirydate);
        //$datetime2 =  DateTime::createFromFormat('d/m/Y',  $nowDate);
        $interval = date_diff($datetime2, $datetime1);
        $total = $interval->format('%R%a days');
        
        if($total < 10){
            return false;
        }
        else {
            return true;
        }
    }
}
 

?>