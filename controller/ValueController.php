<?PHP 
class ValueController {
    function convertToFloat($number) {
        if ($number == 'undefined' || $number == null) return 0;
        
        return (float)filter_var($number, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    function numberFormat($number, $decimal=0, $nzero=true){
        $number = $this->convertToFloat($number);

        if (!$nzero) {
          return $number == 0 ? '' : number_format($number, $decimal);
        } else {
          return number_format($number, $decimal);
        }
    }

    function numberToTextTH($number){ 
        if ($number > 0){ 
            $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
            $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
            $number = str_replace(",","",$number); 
            $number = str_replace(" ","",$number); 
            $number = str_replace("บาท","",$number); 
            $number = explode(".",$number); 

            if(sizeof($number)>2){ 
                return 'ทศนิยมหลายตัวนะจ๊ะ'; 
                exit; 
            } 

            $strlen = strlen($number[0]); 
            $convert = ''; 
            for($i=0;$i<$strlen;$i++){ 
                $n = substr($number[0], $i,1); 
                if($n!=0){ 
                    if($i==($strlen-1) && $n==1){ $convert .= 'เอ็ด'; } 
                    elseif($i==($strlen-2) && $n==2){  $convert .= 'ยี่'; } 
                    elseif($i==($strlen-2) && $n==1){ $convert .= ''; } 
                    else{ $convert .= $txtnum1[$n]; } 
                    $convert .= $txtnum2[$strlen-$i-1]; 
                } 
            } 

            $convert .= 'บาท'; 
            if($number[1]=='0' OR $number[1]=='00' OR 
                $number[1]==''){ 
                $convert .= 'ถ้วน'; 
            }else{ 
                $strlen = strlen($number[1]); 
                for($i=0;$i<$strlen;$i++){ 
                    $n = substr($number[1], $i,1); 
                    if($n!=0){ 
                        if($i==($strlen-1) && $n==1){$convert .= 'เอ็ด';} 
                        elseif($i==($strlen-2) && $n==2){$convert .= 'ยี่';} 
                        elseif($i==($strlen-2) && $n==1){$convert .= '';} 
                        else{ $convert .= $txtnum1[$n];} 
                        $convert .= $txtnum2[$strlen-$i-1]; 
                    } 
                } 
                $convert .= 'สตางค์'; 
            } 
            return $convert; 
        }
    } 
}
?>