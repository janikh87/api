<?php
require_once('inc/config.php');
function custom_autoloader($class) {
  include 'app/' . $class . '.php';
}
spl_autoload_register('custom_autoloader');
(new NumberApiController())->process();
?>
