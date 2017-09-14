<?php
$filename = 'files/test.txt';
$data = 'sdfdsfdsfsdf';
echo file_put_contents($filename, $data, FILE_APPEND);