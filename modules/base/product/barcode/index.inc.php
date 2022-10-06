<?PHP
$path = "modules/base/product/barcode/";

if (isset($_POST['product'])) {
    $_SESSION['product'] = json_decode($_POST['product'], true);
}

if (isset($_SESSION['product'])) {
    $product = $_SESSION['product'];
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
    $mpdf->Output($product['product_code'] . '.pdf', 'I');
} else {
    echo "<script> alert('เอกสารหมดอายุ กรุณาดำเนินการใหม่อีกครั้ง'); window.close(); </script>";
}