<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Definerer en kontant til document root
define("DOCROOT", $_SERVER['DOCUMENT_ROOT']); 
define("COREROOT", str_replace('/public_html', '/core',$_SERVER['DOCUMENT_ROOT']));
require_once(COREROOT . '/classes/autoload.php');
$db = new dbconf();

?>
