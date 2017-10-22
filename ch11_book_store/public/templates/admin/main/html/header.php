<?php
$linkControlPanel = URL::createLink( 'admin', 'control', 'index' );
$linkMyProfile    = URL::createLink( 'admin', 'profile', 'index' );
$linkUserManager  = URL::createLink( 'admin', 'user', 'index' );
$linkAddUser      = URL::createLink( 'admin', 'user', 'add' );
$linkGroupManager = URL::createLink( 'admin', 'group', 'index' );
$linkAddGroup     = URL::createLink( 'admin', 'group', 'add' );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<?php echo $this->_metaHTTP; ?>
	<?php echo $this->_metaName; ?>
    <title><?php echo $this->_title; ?></title>
	<?php echo $this->_cssFiles; ?>
	<?php echo $this->_jsFiles; ?>
</head>
<body>
    <div id="border-top" class="h_blue">
        <span class="title"><a href="#">Administration</a></span>
    </div>

    <!-- HEADER -->
    <div id="header-box">
        <div id="module-status">
            <span class="no-unread-messages"><a href="#">Log out</a></span>
        </div>
        <div id="module-menu">
            <!-- MENU -->
            <ul id="menu" >
                <li class="node"><a href="#">Site</a>
                    <ul>
                        <li><a class="icon-16-cpanel" href="<?php echo $linkControlPanel;?>">Control Panel</a></li>
                        <li class="separator"><span></span></li>
                        <li><a class="icon-16-profile" href="<?php echo $linkMyProfile;?>">My Profile</a></li>
                    </ul>
                </li>
                <li class="separator"><span></span></li>
                <li class="node"><a href="#">Users</a>
                    <ul>
                        <li class="node">
                            <a class="icon-16-user" href="<?php echo $linkUserManager;?>">User Manager</a>
                            <ul id="menu-com-users-users" class="menu-component">
                                <li>
                                    <a class="icon-16-newarticle" href="<?php echo $linkAddUser;?>">Add New User</a>
                                </li>
                            </ul>
                        </li>

                        <li class="node">
                            <a class="icon-16-groups" href="<?php echo $linkGroupManager;?>">Groups</a>
                            <ul id="menu-com-users-groups" class="menu-component">
                                <li>
                                    <a class="icon-16-newarticle" href="<?php echo $linkAddGroup;?>">Add New Group</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="clr"></div>
    </div>