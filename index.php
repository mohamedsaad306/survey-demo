<?php 
require_once("router.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Servey System</title>
	<link href="./css/bootstrap-Sandstone.min.css" rel="stylesheet" />
	<script src="./js/jquery-3.2.1.min.js">;</script>
</head>

<body>
	<div class="container">
		<form action="api.php?surveyid=1" method="POST">
			<div class="form-group">
				<input id= "input-arabicText" type="text" name="" class="form-control">
				<input id= "input-englishText" type="text" name="" class="form-control">
				<button type="submit" value="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</body>

</html>