<?PHP
$html_header .= '
  <table>
    <tr>
        <td align="center">
          <div style="font-size: 12px;"><b>' . $setting['setting_name'] . '</b></div>
      </td>
    </tr>
    <tr>
        <td align="center">
          <div style="font-size: 12px;"><b>ใบสรุปยอดปิดกะ</b></div>
      </td>
    </tr>
  </table>';

$html_header .= '
  <table>
    <tr> 
      <td><b>สถานีขาย : </b>' . $sale_close_shift['sale_station_name'] . '</td>   
    </tr>
    <tr> 
      <td><b>พนักงาน : </b>' . $sale_close_shift['addby'] . ' '  . date('d/m/Y') . ' ' . date('H:i:s') . '</td>
    </tr>
  </table>
  <hr>
 
 ';
$cashes = ['1000', '500', '100', '50', '20', '10', '5', '2', '1', '0.50', '0.25'];

// $html .= '<table><tbody> 
//     <tr>
//       <td><b style="font-size: 10px";> ยอดส่ง : </b></td>
//     </tr>
// ';
$html .= '<table><tbody>';

for ($i = 0; $i < count($cashes); $i++) {
  $html .= '
      <tr>
        <td style="padding-left:20px">
          ' . $cashes[$i] . ' x ' . $value_controller->numberFormat($sale_close_shift['sale_cut_off_out_price_qtys'][$i], 0) . '
        </td> 
        <td align="right">
          ' . $value_controller->numberFormat($sale_close_shift['sale_cut_off_out_price_prices'][$i], 2) . '
        </td>
      </tr>
      <br/> 
    ';
}
for ($i = 0; $i < count($sale_close_shift['sale_close_shift_lists']); $i++) {
  if ($sale_close_shift['sale_close_shift_lists'][$i]['sale_close_shift_debit_receipt_type_shelving'] === 0) {
    $html .= '
      <tr>
        <td>
          ' . $sale_close_shift['sale_close_shift_lists'][$i]['sale_close_shift_debit_receipt_name'] . '
        </td> 
        <td align="right">
          ' . $value_controller->numberFormat($sale_close_shift['sale_close_shift_lists'][$i]['sale_close_shift_debit_receipt_price'], 2) . '
        </td>
      </tr>
      <br/> 
    ';
  }
}

$html .= '</tbody><tfoot>
    <tr>
      <td><b>ยอดส่งทั้งหมด</b></td>
      <td align="right"><b>
      ' . $value_controller->numberFormat($sale_close_shift['sale_close_shift_total_price'], 2) . '
      </b></td>
    </tr>
  </tfoot></table>
';

$html .= '<table style="margin-top:30px">
  <tbody>
      <tr>
          <td align="center">
            ..................................
          </td> 
        </tr>
        <tr>
          <td align="center">
           <b style="font-size: 10px;">พนักงาน</b>  
          </td>
      </tr>
  </tbody>
</table>';
