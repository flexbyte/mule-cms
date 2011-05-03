<?php
error_reporting(0);

$root = dirname(__FILE__).DIRECTORY_SEPARATOR;
$config = array(
	'dir.content' => $root.'content'.DIRECTORY_SEPARATOR,
	'dir.layout'  => $root.'layout'.DIRECTORY_SEPARATOR,
	);

include_once 'mule.php';
$mule = new Mule();
$mule->run($config);


?>