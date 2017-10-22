<?php
function a($number) {
    $result = 1;
    if ($number > 1) {
        $result = $number * a($number -1);
    }
    
    return $result;
}

echo a(4);
