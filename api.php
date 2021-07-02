<?php
require_once('inc/config.php');
function custom_autoloader($class) {
  include 'App/' . $class . '.php';
}
spl_autoload_register('custom_autoloader');
(new NumberApiController())->process();
?>
