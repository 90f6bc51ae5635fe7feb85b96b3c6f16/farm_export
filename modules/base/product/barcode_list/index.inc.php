<?PHP
$path = "modules/base/product/barcode_list/";

if (isset($_POST['product_barcode_lists'])) {
    $_SESSION['product_barcode_lists'] = json_decode($_POST['product_barcode_lists'], true);
}

if (isset($_SESSION['product_barcode_lists'])) {
    $product_barcode_lists = $_SESSION['product_barcode_lists'];
    $min_line = 25;

    include($path . "view.inc.php");
    include("plugins/mpdf/mpdf.php"); 
    $mpdf = new mPDF('th', array(260,260), '0', 'garuda');

    $mpdf->mirrorMargins = false;
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->AddPage(
        'P','','','','',
        5, // margin left
        5, // margin left-right
        5, // margin top
        5, // margin bottom
        5, // margin header
        5 // margin footer
    );

    $mpdf->WriteHTML($html);
    $mpdf->Output($product_barcode_lists['product_code'] . '.pdf', 'I');
} else {
    echo "<script> alert('เอกสารหมดอายุ กรุณาดำเนินการใหม่อีกครั้ง'); window.close(); </script>";
}