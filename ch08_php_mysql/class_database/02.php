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
$data = array(
    'username'  => 'hoanganh',
    'password'  => '123',
    'email'     => 'hoanganh@gmail.com'
);

$database->insert($data);
//echo '<pre>';
//print_r($database);
//echo '</pre>';