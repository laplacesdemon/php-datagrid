<?php 

error_reporting(E_ALL);

// set default timezone (or PHP throws warning when using the date function)
date_default_timezone_set('Europe/Istanbul');

require_once 'BaseTestCase.php';

function __autoload($class_name) {
    $tokens = explode("_", $class_name);
    $fileName = implode("/", $tokens);
    include_once $fileName . '.php';
}
