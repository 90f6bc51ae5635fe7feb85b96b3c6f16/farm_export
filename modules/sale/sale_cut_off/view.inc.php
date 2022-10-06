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
          <div style="font-size: 12px;"><b>ใบส่งยอด</b></div>
      </td>
    </tr>
  </table>';

$html_header .= '
  <table>
    <tr> 
      <td><b>สถานีขาย : </b>' . $sale_cut_off['sale_station_name'] . '</td>   
    </tr>
    <tr> 
      <td><b>พนักงาน : </b>' . $sale_cut_off['addby'] . ' '  . date('d/m/Y') . ' ' . date('H:i:s') . '</td>
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
          ' . $cashes[$i] . ' x ' . $value_controller->numberFormat($sale_cut_off['sale_cut_off_out_price_qtys'][$i], 0) . '
        </td> 
        <td align="right">
          ' . $value_controller->numberFormat($sale_cut_off['sale_cut_off_out_price_prices'][$i], 2) . '
        </td>
      </tr>
      <br/> 
    ';
}

$html .= '</tbody><tfoot>
    <tr>
      <td><b>ยอดส่งทั้งหมด</b></td>
      <td align="right"><b>
      ' . $value_controller->numberFormat($sale_cut_off['sale_cut_off_out_price'], 2) . '
      </b></td>
    </tr>
    <tr>
      <td><b>ยอดรับทั้งหมด</b></td>
      <td align="right"><b>
      ' . $value_controller->numberFormat($sale_cut_off['sale_cut_off_in_price'], 2) . '
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
