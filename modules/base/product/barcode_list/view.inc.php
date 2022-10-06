<?PHP

  
  // var_dump($loop);exit();
  $html .= '<div class="main">
    <table>
      <tbody>';
      $j = 0;
      $col = 0;
 for ($j = 0; $j <= count($product_barcode_lists) && $j < $min_line; $j++) {
  if($product_barcode_lists[$j]['print_number'] < 3 ){
    $loop = 3;
  }else{
    $loop = $product_barcode_lists[$j]['print_number'];
  } 
  for ($i = 0; $i < $loop; $i++,$col++) {

    if ($product_barcode_lists[$j]['product_code'] != '') {
      if((($col+1) % 3) == 1 || ($col+1) == 1){ 
        $html .= '<tr>';
      }

      if($i <= $product_barcode_lists[$j]['print_number']){
        $html .= '
          <td width="33%" align="center">
            <table style="width:90%;">
              <tbody>
                
                <tr>
                  <td align="left" colSpan="2"><b>'.
                    $product_barcode_lists[$j]['product_name'].'#'.
                    $product_barcode_lists[$j]['product_brand_name'].'
                  </b></td>
                </tr>
                <tr>
                  <td align="center" colSpan="2">
                    <barcode code="'.$product_barcode_lists[$j]['product_code'].'" type="C39" size="0.75" height="2.0"/>
                  </td>
                </tr>
                <tr>
                  <td align="center" colSpan="2"><b>'.$product_barcode_lists[$j]['product_code'].'</b></td>
                </tr>
                <tr>
                  <td align="center" colSpan="2"><b>'.$product_barcode_lists[$j]['product_price'].' บาท </b></td>
                </tr>
              </tbody>
            </table>
          </td>
        ';
      }else{
        $html .= '<td width="33%"></td>';
      }
      if((($col+1) % 3) == 0){ 
        $html .= '</tr>';
      }  
      
    } 
  }
 
}
  $html .= '
  </tbody>
  </table>
</div>';

