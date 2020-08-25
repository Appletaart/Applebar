<?php
include ("header.php");

$from_time = date('Y-m-d H:i:m');
$to_time = $_SESSION['end_time'];

$time_first = strtotime($from_time);
$time_second = strtotime($to_time);
$differenceinsecs = $time_second = $time_first;

echo gmdate("H:i:s", $differenceinsecs);

?>