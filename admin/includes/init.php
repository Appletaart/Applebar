<?php

/*defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT .DS. 'admin'.DS. 'includes');
defined('IMAGES_PATH') ? null : define('IMAGES_PATH', SITE_ROOT .DS. 'admin' .DS. 'img');*/

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', DS. 'Applications' .DS. 'MAMP' .DS. 'htdocs' .DS. 'PHPBar');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT .DS. 'admin'.DS. 'includes');
defined('IMAGES_PATH') ? null : define('IMAGES_PATH', SITE_ROOT .DS. 'admin' .DS. 'img');
?>

<?php require_once(INCLUDES_PATH.DS."autoload_class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."dbc.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Database.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Db_object.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Session.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Table.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Slide.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Admins.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Data.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Cart.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Paginate.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Category.Class.php"); ?>
<?php require_once(INCLUDES_PATH.DS."Order_in.Class.php"); ?>


<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

?>