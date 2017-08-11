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

$id = array(200);

echo $delete = $database->delete($id);


