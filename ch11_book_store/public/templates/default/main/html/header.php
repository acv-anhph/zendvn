<?php

$imgURL        = TEMPLATE_URL . 'default/main/images';
$linkHome      = URL::createLink('default', 'index', 'index');
$linkCategory  = URL::createLink('default', 'category', 'index');
$linkMyAccount = URL::createLink('default', 'user', 'index');
$linkRegister  = URL::createLink('default', 'index', 'register');
$linkLogin     = URL::createLink('default', 'index', 'login');
$linkLogout    = URL::createLink('default', 'user', 'logout');
$linkAdmin     = URL::createLink('admin', 'index', 'index');

$user = Session::get('user');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <title><?php echo $this->_title; ?></title>
    <?php echo $this->_cssFiles; ?>
    <?php echo $this->_jsFiles; ?>

</head>
<body>
<div id="wrap">
    <div class="header">
        <div class="logo">
            <a href="<?php echo $linkHome; ?>">
                <img src="<?php echo $imgURL; ?>/logo.gif" alt="" title="" border="0"/>
            </a>
        </div>
        <div id="menu">
            <ul>
                <li class="index-index"><a href="<?php echo $linkHome; ?>">HOME</a></li>
                <li class="category-index"><a href="<?php echo $linkCategory; ?>">Category</a></li>
                <?php if ($user['login']): ?>
                    <li class="user-index"><a href="<?php echo $linkMyAccount; ?>">My Account</a></li>
                    <li class="user-logout"><a href="<?php echo $linkLogout; ?>">Logout</a></li>
                    <?php if($user['info']['group_acp'] == 1): ?>
                        <li><a href="<?php echo $linkAdmin; ?>">Go to admin page</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="index-login"><a href="<?php echo $linkLogin; ?>">Login</a></li>
                    <li class="index-register"><a href="<?php echo $linkRegister; ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>