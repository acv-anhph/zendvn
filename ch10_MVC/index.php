<?php
require_once('config.php');
function __autoload($clasName) {
    require_once LIBRARY_PATH . "{$clasName}.php";
}

$bootstrap = new Bootstrap();
$bootstrap->init();
