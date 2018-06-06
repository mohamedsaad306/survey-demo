<!DOCTYPE html>
<html>
<head>
	<title>Servey System</title>
	<link href="css/bootstrap-Sandstone.min.css" rel="stylesheet" />
	<script src="js/jquery-3.2.1.min.js"></script>
</head>

<body>
	<div class="container">



		<form action="#" method="POST" id= "submit-survey">
			<div class="form-group ">
				
				<div class="form-group">
					<label for="surveyName">Survey Name </label>
					<input type="text" class="form-control" id="surveyName" name="surveyName" placeholder="Survey Name">
				</div>
				<button type="submit" value="submit" class="btn btn-primary">Create</button>
			</div>
		</form>

		<div class="well">
			<h4>Display survey answers </h4>
			<label for="surveyName">Survey Name</label>
			<h4>This is a quetion </h4>

			<div class="radio-inline">
				<label class="radio-inline">
					<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
					Very Good
				</label>

				<label class="radio-inline">
					<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
					Good
				</label>

			</div>

		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () 
		{
			// Variable to hold request
			var request;

// Bind to the submit event of our form
$("#submit-survey").submit(function(event){
	event.preventDefault();
	if (request) {
		request.abort();
	}     
	var $form = $(this);
	var $inputs = $form.find("input, select, button, textarea");
	var serializedData = $form.serialize();
	$inputs.prop("disabled", true);
    // Fire off the request to /form.php
    request = $.ajax({
    	url: "api.php?action=createSurvey",
    	type: "post",
    	data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log(response);
        alert(response);

    });

    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
        	"The following error occurred: "+
        	textStatus, errorThrown	
        	);
    });

    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });
});

});

</script>
</body>
</html>