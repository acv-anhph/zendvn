<?php

$path = 'files/01.txt';
echo basename($path) . '<br>';
echo basename($path, '.txt') . '<br>';
echo dirname($path) . '<br>';

$info = pathinfo($path);
echo '<pre>';
print_r($info);
echo '</pre>';