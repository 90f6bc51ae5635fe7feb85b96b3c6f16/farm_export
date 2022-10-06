<?PHP
require_once('models/SettingModel.php');
$setting_model = new SettingModel;
$path = "modules/sale/receipt/";

if (isset($_POST['receipt'])) {
    $_SESSION['receipt'] = json_decode($_POST['receipt'], true);
    $_SESSION['receipt_lists'] = json_decode($_POST['receipt_lists'], true);
}

if (isset($_SESSION['receipt'])) {
    $setting = $setting_model->getSettingBy();
    $receipt = $_SESSION['receipt'];
    $receipt_lists = $_SESSION['receipt_lists'];
    $min_line = 10;
    $max_length = ((120 + (count($receipt_lists) * 5.9) + (count($receipt['receipt_discount_lists']) * 15)));
    // $max_length = ((120 + (count($receipt_lists) * 5.9) + (count($receipt['receipt_discount_lists']) * 5.9)));

    include($path . "view.inc.php");
    include("plugins/mpdf/mpdf.php");
    $mpdf = new mPDF('th', array(80, $max_length), '0', 'garuda');
    // var_dump($receipt);
    // exit();
    $mpdf->mirrorMargins = false;
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetHTMLHeader($html_header);

    $mpdf->AddPage(
        'P',
        '',
        '',
        '',
        '',
        5, // margin left
        5, // margin left-right
        55, // margin top
        5, // margin bottom
        10, // margin header
        5 // margin footer
    );

    $mpdf->WriteHTML($html);
    $mpdf->Output($receipt['receipt_code'] . '.pdf', 'I');
} else {
    echo "<script> alert('เอกสารหมดอายุ กรุณาดำเนินการใหม่อีกครั้ง'); window.close(); </script>";
}
