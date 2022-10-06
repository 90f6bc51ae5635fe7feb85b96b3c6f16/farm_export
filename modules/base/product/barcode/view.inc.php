<?PHP
  if($product['print_number'] < 3){
    $loop = 3;
  }else{
    $loop = $product['print_number'];
  } 

  $html .= '<div class="main">
    <table>
      <tbody>';
  for ($i = 0; $i <= $loop; $i++) {
    if ($product['product_code'] != '') {
      if((($i+1) % 3) == 1 || ($i+1) == 1){ 
        $html .= '<tr>';
      }

      if($i <= $product['print_number']){
        $html .= '
          <td width="33%" align="center">
            <table style="width:90%;">
              <tbody>
               
                <tr>
                  <td align="left" colSpan="2"><b>'.
                    $product['product_name'].' '.
                    $product['product_brand_name'].'
                  </b></td>
                </tr>
                <tr>
                  <td align="center" colSpan="2">
                    <barcode code="'.$product['product_code'].'" type="C39" size="0.75" height="2.0"/>
                  </td>
                </tr>
                <tr>
                  <td align="center" colSpan="2"><b>'.$product['product_code'].'</b></td>
                </tr>
                <tr>
                  <td text align="center" colSpan="2"><b>'.$product['product_price'].' บาท </b></td>
                </tr>
              </tbody>
            </table>
          </td>
        ';
      }else{
        $html .= '<td width="33%"></td>';
      }

      if((($i+1) % 3) == 0){ 
        $html .= '</tr>';
      }
    } 
  }  

  $html .= '</tbody>
    </table>
  </div>';

