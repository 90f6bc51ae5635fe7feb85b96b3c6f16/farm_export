<?PHP
//BASE
if ($_GET['export'] == "barcode") {
    require_once("modules/base/product/barcode/index.inc.php");
} elseif ($_GET['export'] == "barcode_list") {
    require_once("modules/base/product/barcode_list/index.inc.php");
} else if ($_GET['export'] == "receipt") {
    require_once("modules/sale/receipt/index.inc.php");
} else if ($_GET['export'] == "sale_close_shift") {
    require_once("modules/sale/sale_close_shift/index.inc.php");
} else if ($_GET['export'] == "sale_cut_off") {
    require_once("modules/sale/sale_cut_off/index.inc.php");
} else {
    echo "<script> alert('ไม่พบเอกสาร'); window.close(); </script>";
}
