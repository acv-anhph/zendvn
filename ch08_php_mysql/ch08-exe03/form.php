<?php

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title><?php echo $titlePage;?></title>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/my-js.js"></script>
</head>
<body>
	<div id="wrapper">
    	<div class="title"><?php echo $titlePage;?></div>
        <div id="form">   
        	<?php echo $error . $success; ?>
			<form action="<?php echo $linkForm;?>" method="post" name="add-form">
				<div class="row">
					<p>Name</p>
					<input type="text" name="name" value="<?php echo $outValidate['name'];?>">
				</div>
				
				<div class="row">
					<p>Status</p>
					<?php echo $status;?>
				</div>
				
				<div class="row">
					<p>Ordering</p>
					<input type="text" name="ordering" value="<?php echo $outValidate['ordering'];?>">
				</div>
				
				<div class="row">
					<input type="submit" value="Save" name="submit">
					<input type="button" value="Cancel" name="cancel" id="cancel-button">
					<input type="hidden" value="<?php echo time();?>" name="token" />
				</div>
												
			</form>    
        </div>
        
    </div>
</body>
</html>
