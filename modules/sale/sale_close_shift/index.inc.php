<?PHP
require_once('models/SettingModel.php');
$setting_model = new SettingModel;
$path = "modules/sale/sale_close_shift/";

if (isset($_POST['sale_close_shift'])) {
    $_SESSION['sale_close_shift'] = json_decode($_POST['sale_close_shift'], true);
}

if (isset($_SESSION['sale_close_shift'])) {
    $setting = $setting_model->getSettingBy();
    $sale_close_shift = $_SESSION['sale_close_shift'];
    $min_line = 10;

    include($path . "view.inc.php");
    include("plugins/mpdf/mpdf.php");
    $mpdf = new mPDF('th', array(80, 175), '0', 'garuda');
    
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
        40, // margin top
        5, // margin bottom
        10, // margin header
        5 // margin footer
    );

    $mpdf->WriteHTML($html);
    $mpdf->Output($sale_close_shift['sale_close_shift_code'] . '.pdf', 'I');
} else {
    echo "<script> alert('เอกสารหมดอายุ กรุณาดำเนินการใหม่อีกครั้ง'); window.close(); </script>";
}
