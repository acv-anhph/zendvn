<?php
$groupLink = URL::createLink('admin', 'group', 'index');
$userLink = URL::createLink('admin', 'user', 'index');
$categoryLink = URL::createLink('admin', 'category', 'index');


?>

<div id="submenu-box">
	<div class="m">
		<ul id="submenu">
			<li><a href="<?php echo $userLink ?>" class="active">User</a></li>
			<li><a href="<?php echo $groupLink ?>">Group</a></li>
			<li><a href="<?php echo $categoryLink ?>">Category</a></li>
		</ul>
		<div class="clr"></div>
	</div>
</div>
