<?PHP
session_start();
date_default_timezone_set('Asia/Bangkok');

ini_set("memory_limit", "-1");
ini_set('max_execution_time', 300);

require_once('controller/ValueController.php');
require_once('controller/DateTimeController.php');
$SERVER = "http://54.254.134.236:6201/";
// $SERVER = "http://localhost:3000/";

// $SERVER = "http://ec2-13-229-233-71.ap-southeast-1.compute.amazonaws.com:3002/";

$value_controller = new ValueController;
$datetime_controller = new DateTimeController;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>KOP GIFT SHOP EXPORT</title>
</head>

<body>
  <?php
  require_once("views/header.inc.php");
  require_once("views/style.inc.php");
  require_once("views/body.inc.php");
  ?>
</body>

</html>