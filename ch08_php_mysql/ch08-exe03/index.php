<?php

	
	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Manage Group</title>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/my-js.js"></script>
</head>
<body>
	<div id="wrapper">
    	<div class="title">Manage Group</div>
        <div class="list">  
        
			<form action="#" method="post" name="main-form" id="main-form">
	         	<div class="row" style="text-align: center; font-weight: bold;">
	            	<p class="no"><input type="checkbox" name="check-all" id="check-all" /></p>
	                <p class="name">Group Name</p>
	                <p class="id">ID</p>
	                <p class="size">Status</p>
	                <p class="size">Ordering</p>
	                <p class="size">Members</p>
	                <p class="action">Action</p>
	            </div>
	            <input type="hidden" value="" name="token" />
	         	
	    	</form>
    	</div>
        <div id="area-button">
        	<a href="form.php?action=add">Add Group</a>
        	<a id="multy-delete" href="#">Delete Group</a>
        </div>
    </div>
</body>
</html>
