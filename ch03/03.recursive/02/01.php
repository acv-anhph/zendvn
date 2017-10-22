<?php
// 1+ 2 + 3 + ... + n
function sum($n) {
    $sum = 0;
    if ($n >= 1) {
        $sum = $n + sum($n -1);
    }
    
    return $sum;
}

echo sum(6);