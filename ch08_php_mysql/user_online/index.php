<?php
require_once 'class/Database.class.php';

$params = array(
    'server'    => 'localhost',
    'user'      => 'root',
    'password'  => '',
    'database'  => 'zendvn',
    'table'     => 'online'
);

$database = new Database($params);

//echo '<pre>';
//print_r($_SERVER);
//echo '</pre>';

$ip = $_SERVER['REMOTE_ADDR'];
$url = $_SERVER['PHP_SELF'];

//tim kiem userInfo trong online
$query = "SELECT `id` FROM online WHERE `ip` = '". $ip . "' " . "AND `url` = '" . $url . "'";
$flagExit = $database->checkExit($query);
$arrData = array('ip' => $ip, 'url' => $url, 'time' => time());

if ($flagExit) {
    $where = array(
            ['ip', $ip, 'and'],
            ['url', $url, '']
    );
    
    $database->update($arrData, $where);
} else {
    $database->insert($arrData);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>User online</title>
</head>
<body>
    <div id="wrapper">
        <div class="title">User online</div>
        <div id="form">
            <?php echo __FILE__; ?>
        </div>
    </div>
</body>
</html>
