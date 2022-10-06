<?PHP 
class DateTimeController{
    function changeDateFormat($date,$char = '-'){
        if ($date != '' && $date > 0){
            $dt = explode(' ',$date);
            $dt = explode($char,$dt[0]);
            $all = $dt[2].$char.$dt[1].$char.$dt[0];
            return $dt[2].$char.$dt[1].$char.$dt[0];
        }else{
            return '';
        }
    }
}
