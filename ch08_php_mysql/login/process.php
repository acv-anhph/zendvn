<?php session_start();
require_once 'functions.php';
require_once 'class/Database.class.php';


if (isset($_SESSION['flagPermission']) && $_SESSION['flagPermission'] == true) {
    if ($_SESSION['timeout'] + 3600 > time()) {
        echo '<h3>Xin chào: ' . $_SESSION['userInfo']['username'] . '</h3>';
        echo '<a href="logout.php">Đăng xuất</a>';
    } else {
        session_unset();
        header('location: login.php');
    }
} else {
    if (!checkEmpty($_POST['username']) && !checkEmpty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $params = array(
            'server' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'zendvn',
            'table' => 'manage_user'
        );
        $database = new Database($params);
        
        $query[] = "SELECT *";
        $query[] = "FROM `manage_user`";
        $query[] = "WHERE `username` = '" . $username . "'";
        $query[] = "AND `password` = '" . $password . "'";
        
        $query = implode(" ", $query);

//                    echo($query);
        
        $a = $database->query($query);
        $userInfo = $database->singleRecord($a);
//                    var_dump($userInfo);
        
        if (!empty($userInfo)) {
            $_SESSION['userInfo'] = $userInfo;
            $_SESSION['flagPermission'] = true;
            $_SESSION['timeout'] = time();
            echo '<h3>Xin chào: ' . $_SESSION['userInfo']['username'] . '</h3>';
            echo '<a href="logout.php">Đăng xuất</a>';
        } else {
            header('Location: login.php');
        }
    } else {
        header('Location: login.php');
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Process</title>
</head>
<body>
    <div id="wrapper">
        <div class="title">PROCESS</div>
        <div id="form">

        </div>

    </div>
</body>
</html>
