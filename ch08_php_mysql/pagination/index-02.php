<?php
require_once 'connect.php';
require_once 'class/Pagination.class.php';

$total_item = $database->countItem("SELECT `id` FROM `manage_user`");
$total_item_per_page = 2;
$page_range = 3;
$current_page = (isset($_GET['page']))? $_GET['page'] : 1;
$start_user_position = ($current_page - 1) * $total_item_per_page;

$paginator = new Pagination($total_item, $total_item_per_page, $page_range, $current_page);
$paginationHTML = $paginator->showPagination();


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
        $row = ($i % 2 == 0) ? 'even' : 'odd';
        $xhtml .= '<div class="row ' . $row . '">
                <p class="id">' . $user['id'] . '</p>
                <p class="username">' . $user['username'] . '</p>
                <p class="fullname">' . $user['fullname'] . ' Name</p>
                <p class="email">' . $user['email'] . '</p>
                <p class="status">' . $user['status'] . '</p>
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
                <p class="birthday">Birthday</p>
                <p class="status">Status</p>
                <p class="ordering">Ordering</p>
            </div>
            <?php echo $xhtml; ?>
        </div>
        <div id="pagination">
            <?php echo $paginationHTML; ?>
        </div>
    </div>
</body>
</html>
