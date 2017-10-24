<?php

require_once 'magento/lib/student.php';

use Magento\Lib as ML;

$student = new ML\Student();

echo '<pre>';
print_r($student);
echo '</pre>';

ML\show_name('hoang anh');
echo '<br>';
echo ML\MAGENTO;