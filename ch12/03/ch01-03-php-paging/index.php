<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Show Data</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>		
<body>
	<div class="container list-course">
		<h1 class="page-header">Khoá học trực tuyến</h1>
		<div class="row content-course">

		</div>
		<div class="row pages" >
			<div class="input-group col-md-4 col-md-offset-4">
				<div class="input-group-btn">
					<button type="button" class="btn btn-default pageInfo" disabled="disabled">Page 1 of 6</button>
					<button type="button" class="btn btn-default goPrevious">&laquo; Previous</button>
				</div>
				<select class="form-control" id="slbPages">
					
				</select>
				<div class="input-group-btn">
					<button type="button" class="btn btn-default goNext">Next &raquo;</button>
				</div>
			</div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/paging.js"></script>
</body>
</html>