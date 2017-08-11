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
$arrData = array(
    array('username'=>'Admin 1', 'password' => '12345'),
    array('username'=>'Admin 2'),
    array('username'=>'Admin 3', 'password' => 'admin3'),
    array('id' => 200, 'username'=>'Admin 4', 'password' => '45654654')
);

echo $lastID = $database->insert($arrData, 'multiple');

