<?php

/*define('DB_HOST', '188.121.44.76:3306');
define('DB_USER', 'applebar');
define('DB_PASS', 'Kouf43~7');
define('DB_NAME', 'applebar');*/

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','applebar');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
OR die('Could not connect to Mysql: ' . mysqli_connect_error());