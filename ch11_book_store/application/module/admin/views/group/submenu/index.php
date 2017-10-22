<?php
$groupLink = URL::createLink('admin', 'group', 'index');
$userLink = URL::createLink('admin', 'user', 'index');


?>

<div id="submenu-box">
	<div class="m">
		<ul id="submenu">
			<li><a href="<?php echo $userLink ?>">User</a></li>
			<li><a class="active" href="<?php echo $groupLink ?>">Group</a></li>
		</ul>
		<div class="clr"></div>
	</div>
</div>
