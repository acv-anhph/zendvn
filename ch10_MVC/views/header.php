<?php
$cssURL	= PUBLIC_URL . 'css' . DS;
$jsURL	= PUBLIC_URL . 'js' . DS;
$fileJs = '';
$fileCss = '';

$menu = '<a class="index" href="index.php?controller=index&action=index">Home</a>';
if (Session::get('loggedIn') == true) {
    $menu .= '<a class="group" href="index.php?controller=group&action=index">Group</a>';
    $menu .= '<a class="user" href="index.php?controller=user&action=logout">Logout</a>';
} else {
    $menu .= '<a class="user" href="index.php?controller=user&action=login">Login</a>';
}

if(!empty($this->js)){
	foreach($this->js as $js) {
		$fileJs .= '<script type="text/javascript" src="'.VIEW_URL.$js.'"></script>';
	}
}

if(!empty($this->css)){
	foreach($this->css as $css) {
		$fileCss .= '<link rel="stylesheet" type="text/css" href="'.VIEW_URL.$css.'">';
	}
}

$pageTitle = (!empty($this->title)) ? $this->title : 'MVC';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle;?></title>
    <link href="<?php echo PUBLIC_URL ?>css/style.css" rel="stylesheet">
	<?php echo $fileCss;?>
    
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h3>Header</h3>
            <?php echo $menu ?>
        </div>
    