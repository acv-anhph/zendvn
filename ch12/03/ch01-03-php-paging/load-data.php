<?php
require_once 'data.php';

$type = $_POST['type'];

if ($type == 'count') {
    $arrayData = createData();

    $totalItems = count($arrayData);
    $items      = $_POST['itemsPerPage'];

    $result['pages']  = ceil($totalItems / $items);
    $result['totals'] = $totalItems;

    echo json_encode($result);
}

if ($type == 'list') {
    $currentPage = $_POST['currentPage'];
    $items       = $_POST['itemsPerPage'];
    $position    = ($currentPage - 1) * $items;

    $arrayData = createData();
    $result    = getElements($arrayData, $position, $items);
    echo json_encode($result);
}