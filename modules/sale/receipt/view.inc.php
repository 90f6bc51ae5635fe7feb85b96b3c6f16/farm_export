<?PHP

$html_header .= '
  <table>
    <tr>
        <td align="center">
          <div style="font-size: 12px;"><b>' . $setting['setting_name'] . '</b></div>
          <div style="font-size: 12px;">' . $setting['setting_email'] . '</div>
          Tel.' . $setting['setting_tel'] . ' Fax.' . $setting['setting_fax'] . ' เลขประจำตัวผู้เสียภาษี ' . $setting['setting_tax'] . '
      </td>
    </tr>
  </table>';

$html_header .= '
  <table>
    <tr> 
      <td><b>สถานีขาย : </b>' . $receipt['sale_station_name'] . '</td>   
    </tr>
    <tr> 
      <td><b>พนักงาน : </b>' . $receipt['addby'] . ' '  . date('d/m/Y') . ' ' . date('H:i:s') . '</td>
    </tr>
  </table>
  <hr>
  <table>
    <tr>
      <td align="center">
        <b> ใบเสร็จรับเงิน / รายการสินค้า</b>
      </td>
    </tr>
  </table>
 
';
$html .= '<table><tbody>';
for ($i = 0; $i < count($receipt_lists); $i++) {
  $total_qty += $receipt_lists[$i]['receipt_list_qty'];
  $total_price += $receipt_lists[$i]['receipt_list_total_price'];
  if ($receipt_lists[$i]['product_code'] != '') {
    $html .= '
      <tr>
        <td>
          ' . $receipt_lists[$i]['receipt_list_name'] . ' x ' . $value_controller->numberFormat($receipt_lists[$i]['receipt_list_qty'], 0) . '
        </td> 
        <td align="right">
          ' . $value_controller->numberFormat($receipt_lists[$i]['receipt_list_price'], 2) . '
        </td>
      </tr>
    ';
  }
}

$html .= '<tr>
    <td>สินค้า  ' . $total_qty . ' ชิ้น รวมเป็นเงิน </td>
    <td align="right">
    ' . $value_controller->numberFormat($total_price, 2) . '
   </td>
  </tr>
';
if (count($receipt['receipt_discount_lists']) > 0) {
  $html .= '<tr>
          <td>โปรโมชัน / ส่วนลด</td>
        </tr>
    ';

  for ($i = 0; $i < count($receipt['receipt_discount_lists']); $i++) {
    if ($receipt['receipt_discount_lists'][$i]['promotion_type_code'] !== 'RG') {
      $html .= '<tr> 
          <td style="padding-left:20px">
          ' . $receipt['receipt_discount_lists'][$i]['receipt_discount_list_name'] . ' 
          </td> 
          <td align="right">
          ' . $value_controller->numberFormat($receipt['receipt_discount_lists'][$i]['receipt_discount_list_total_price'], 2) . '
          </td>
        </tr>
      ';
    }
  }

  $html .= '
    <tr>
      <td style="padding-left:20px">ส่วนลดทั้งหมด </td>
      <td align="right">
      ' . $value_controller->numberFormat($receipt['receipt_discount_price'], 2) . '
      </td>
    </tr>
  ';
}

$html .= '</tbody><tfoot>
    <tr>
      <td><b>รวมยอดสุทธิ </b></td>
      <td align="right"><b>
      ' . $value_controller->numberFormat($receipt['receipt_total_price'], 2) . '
      </b></td>
    </tr>
  ';

$html .= '</tfoot></table>';

if ($receipt['customer_code'] != "") {
  $html .= '<hr>
    <table>
      <tr>
        <td width="240" style="padding-right: 0px;">
          <table>
            <tr> 
              <td>ข้อมูลสมาชิก : ' . $receipt['customer_full_name'] . '</td>
            </tr>
            <tr>
              <td>แต้มสะสมคงเหลือ : ' . $receipt['points_balance'] . '</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>';
}

$total_redeem_gift = $receipt['receipt_discount_list_redeem_gifts'];

if (count($total_redeem_gift) > 0) {
  $html .= '.................................................................';
  $html .= '<table><tr><td>ได้รับของแถมและสิทธิแลกซื้อดังนี้</td></tr></table>';
  $html .= '<table><tbody>';

  for ($i = 0; $i < count($total_redeem_gift); $i++) {
    if ($total_redeem_gift[$i]['product_discount_type'] === 'gift') {
      $html .= ' 
        <tr>
          <td>  
            ' . $total_redeem_gift[$i]['product_name'] . ' (ของแถม)
          </td> 
          <td align="right">
            ' . $value_controller->numberFormat($total_redeem_gift[$i]['product_qty'], 0) . ' ชิ้น
          </td>
        </tr> ';
    } else {
      $html .= ' 
        <tr>
          <td>  
            ' . $total_redeem_gift[$i]['product_name'] . ' (รับ' . $total_redeem_gift[$i]['product_discount_type_name']  . 'ในราคา ' . $total_redeem_gift[$i]['product_discount_price']  . ' บาท/ชิ้น)
          </td> 
          <td align="right">
            ' . $value_controller->numberFormat($total_redeem_gift[$i]['product_qty'], 0) . ' ชิ้น
          </td>
        </tr> ';
    }
  }
  $html .= '</tbody></table>';
  $html .= '<table> 
              <tr>
                <td>
                  <barcode code="' . $receipt['receipt_code'] . '" type="C39" size="0.75" height="1.5"/> 
                </td>
              </tr>
            </table>';
  $html .= '<table><tr><td align="center"><b>สามารถนำใบเสร็จไปสแกนเพื่อรับของแถมได้ภายในวันที่' . $receipt['receipt_promotion_date_start'] . ' - ' . $receipt['receipt_promotion_date_end']  . ' </b></td></tr></table>';
}
