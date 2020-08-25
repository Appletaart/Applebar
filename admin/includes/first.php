<?php
include ("dbc.php");

$duration = "";

$sql = mysqli_query($dbc, "SELECT duration FROM orders where id=10");

while($row = mysqli_fetch_array($sql)){
    $duration = $row['duration'];
}

$_SESSION['duration'] = $duration;
$_SESSION['start_time'] = date("Y-m-d H:i:s");

$end_time = $end_time = date("Y-m-d H:i:s", strtotime("+". $_SESSION['duration'] . "minutes", strtotime($_SESSION['start_time'])));
$_SESSION['end_time'] = $end_time;

redirect_to("sendOrder.php");

?>