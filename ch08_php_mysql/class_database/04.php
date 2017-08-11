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

$data 	= array('password' => 1, 'email' => 'abc1@yahoo.com');
$where	= array(
    array('username', 'Admin 2', 'and'),
    array('password', null, '')
);

echo $update = $database->update($data, $where);


