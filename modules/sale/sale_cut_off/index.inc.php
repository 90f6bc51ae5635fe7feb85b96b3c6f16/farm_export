<?PHP
require_once('models/SettingModel.php');
$setting_model = new SettingModel;
$path = "modules/sale/sale_cut_off/";

if (isset($_POST['sale_cut_off'])) {
    $_SESSION['sale_cut_off'] = json_decode($_POST['sale_cut_off'], true);
}

if (isset($_SESSION['sale_cut_off'])) {
    $setting = $setting_model->getSettingBy();
    $sale_cut_off = $_SESSION['sale_cut_off'];
    $min_line = 10;

    include($path . "view.inc.php");
    include("plugins/mpdf/mpdf.php");
    $mpdf = new mPDF('th', array(80, 150), '0', 'garuda');
    
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
    $mpdf->Output($sale_cut_off['sale_cut_off_code'] . '.pdf', 'I');
} else {
    echo "<script> alert('เอกสารหมดอายุ กรุณาดำเนินการใหม่อีกครั้ง'); window.close(); </script>";
}
