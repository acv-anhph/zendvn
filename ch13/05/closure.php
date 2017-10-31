<?php

$arr = array(1,2,3,4,5,6,7);

$compare = function ($value) {
    return function ($max) use ($value) {
        return ($max > $value);
    };
};

$output = array_filter($arr, $compare(3));

echo '<pre>';
print_r($output);
echo '</pre>';

$name = 'hoang anh';

echo "hello {$name}";