<?php

$imgURL = TEMPLATE_URL . 'default/main/images';
$linkHome = URL::createLink('default', 'index', 'index');
$linkCategory = URL::createLink('default', 'category', 'index');
$linkMyAccount = URL::createLink('default', 'user', 'index');
$linkRegister = URL::createLink('default', 'user', 'register');
$linkLogin = URL::createLink('default', 'user', 'login');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <?php echo $this->_title; ?>
    <?php echo $this->_cssFiles; ?>
    <?php echo $this->_jsFiles; ?>

</head>
<body>
<div id="wrap">
    <div class="header">
        <div class="logo">
            <a href="<?php echo $linkHome;?>">
                <img src="<?php echo $imgURL; ?>/logo.gif" alt="" title="" border="0"/>
            </a>
        </div>
        <div id="menu">
            <ul>
                <li class="index-index"><a href="<?php echo $linkHome;?>">HOME</a></li>
                <li class="category-index"><a href="<?php echo $linkCategory;?>">Category</a></li>
                <li class="user-index"><a href="<?php echo $linkMyAccount;?>">My Account</a></li>
                <li class="user-register"><a href="<?php echo $linkRegister;?>">Register</a></li>
                <li class="user-login"><a href="<?php echo $linkLogin;?>">Login</a></li>
            </ul>
        </div>
    </div>