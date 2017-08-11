<?php
require_once 'database.php';

$params = array(
    'server'    => 'localhost',
    'user'      => 'root',
    'password'  => '',
    'database'  => 'zendVN',
    'table'     => 'manage_user'
);

$query[] 	= "SELECT * ";
$query[] 	= "FROM `manage_user`";
$query[] 	= "ORDER BY `id` DESC";
$query		= implode(" ", $query);

$database = new Database($params);

$database->query($query);
$list = $database->listRecord();

echo'<pre>';
print_r($list);
echo'</pre>';


