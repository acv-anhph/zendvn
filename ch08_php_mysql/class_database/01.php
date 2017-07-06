<?php
require_once 'database.php';

$params = array(
    'server'    => 'localhost',
    'user'      => 'root',
    'password'  => '',
    'database'  => 'zendVN',
    'table'     => 'manage_user'
);

$database = new Database($params);

//echo '<pre>';
//print_r($database);
//echo '</pre>';