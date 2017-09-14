<?php
require_once 'connect.php';

$total_item = $database->countItem("SELECT `id` FROM `manage_user`");
$total_item_per_page = 2;
$total_page = ceil($total_item/$total_item_per_page);
$current_page = (isset($_GET['page']))? $_GET['page'] : 1;
$start_user_position = ($current_page - 1) * $total_item_per_page;
$page_range = 3;
$list_page = '';
if ($current_page < 1 || $current_page > $total_page) {
    header('location: error.php');
}

$start = '<li>Start</li>';
$prev = '<li>Previous</li>';
if ($current_page > 1) {
    $start = '<li><a href="?page=1">Start</a></li>';
    $prev = '<li><a href="?page='. ($current_page - 1) .'">Previous</a></li>';
}

$next = '<li>Next</li>';
$end = '<li>End</li>';
if ($current_page < $total_page) {
    $end = '<li><a href="?page='.$total_page.'">End</a></li>';
    $next = '<li><a href="?page='. ($current_page + 1) .'">Next</a></li>';
}

if ($page_range < $total_page) {
    if ($current_page == 1) {
        $start_page = 1;
        $end_page = $page_range;
    } elseif($current_page == $total_page) {
        $start_page = $total_page - $page_range + 1;
        $end_page = $total_page;
    } else {
        $start_page = $current_page - ($page_range - 1)/2;
        $end_page = $current_page + ($page_range - 1)/2;
        if ($start_page < 1) {
            $start_page = 1;
            $end_page = $start_page + $page_range - 1;
        }
        
        if ($end_page > $total_page) {
            $end_page = $total_page;
            $start_page = $end_page - $page_range + 1;
        }
    }
} else {
    $start_page = 1;
    $end_page = $total_page;
}


for ($i = $start_page; $i <= $end_page; $i++) {
    if ($i == $current_page) {
        $list_page .= '<li class="active">'.$i.'</li>';
    } else {
        $list_page .= '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
    }
}

$paginationHTML = '<ul class="pagination">' . $start . $prev . $list_page . $next . $end . '</ul>';

$query[] = "SELECT `id`, `username`, CONCAT(`firstname`, ' ', `lastname`) AS fullname, `email`, `status` FROM `manage_user`";
$query[] = "LIMIT $start_user_position, $total_item_per_page";
$query = implode(' ', $query);
$list_user = $database->listRecord($query);
//echo '<pre>';
//print_r($list_user);
//echo '</pre>';

if (!empty($list_user)) {
    $xhtml = '';
    $i = 0;
    foreach ($list_user as $user) {
        $row = ($i % 2 == 0)? 'even' : 'odd';
        $xhtml .= '<div class="row ' . $row . '">
                <p class="id">'.$user['id'].'</p>
                <p class="username">'.$user['username'].'</p>
                <p class="fullname">'.$user['fullname'].' Name</p>
                <p class="email">'.$user['email'].'</p>
                <p class="status">'.$user['status'].'</p>
                </div>';
        $i++;
    }
} else {
    $xhtml = 'dữ liệu đang cập nhật';
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Manage User</title>
</head>
<body>
    <div id="wrapper">
        <div class="title">Manage User</div>
        <div class="list">
            <div class="row head">
                <p class="id">ID</p>
                <p class="username">UserName</p>
                <p class="fullname">Full Name</p>
                <p class="email">Email</p>
                <p class="status">Status</p>
            </div>
            <?php echo $xhtml; ?>
        </div>
        <div id="pagination">
            <?php echo $paginationHTML; ?>
        </div>
    </div>
</body>
</html>
