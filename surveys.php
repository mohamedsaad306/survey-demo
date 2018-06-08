<!DOCTYPE html>
<html>
<head>
	<title>Servey Application</title>
	<link href="css/bootstrap.css" rel="stylesheet" />
	<script src="js/jquery-3.2.1.min.js"></script>
</head>

<body>
	<div class="container">
		<br>
		<form action="#" method="POST" id= "submit-survey">
			<div class="form-group ">
				<div class="form-group">
					<label for="surveyName"><h4>New survey name</h4> </label>
					<input type="text" class="form-control" id="surveyName" name="surveyName" placeholder="Survey Name" required="">
				</div>
				<button type="submit" value="submit" class="btn btn-primary">Create</button>
			</div>
		</form>
		<br>

		<div class="list-group" id="survyesList">
			
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () 
		{
			var survyes= getAllSurveyes();
			if (survyes) 
				renderSurveyes(survyes);
			
			var request;
			$("#submit-survey").submit(function(event){
				event.preventDefault();
				if (request) {
					request.abort();
				}     
				var $form = $(this);
				var $inputs = $form.find("input, select, button, textarea");
				var serializedData = $form.serialize();
				//$inputs.prop("disabled", true);
				request = $.ajax({
					url: "api.php?action=createSurvey",
					type: "post",
					data: serializedData
				});


				request.done(function (response, textStatus, jqXHR){

					console.log(response);
					// alert(response);
					if (response) {location.reload()}
				});

				request.fail(function (jqXHR, textStatus, errorThrown){

					console.error(
						"The following error occurred: "+
						textStatus, errorThrown	
						);
				});

				request.always(function () {

					$inputs.prop("disabled", false);
				});
			});

		});
		function getAllSurveyes() {
			var req = $.ajax({
				url: "api.php?action=getAllSurveyesList",
				type: "GET",
				async: false,
			}).responseText;

			result = JSON.parse(req);

			return result;
		}
		function renderSurveyes(survyes) {
			console.log(survyes);
			if (survyes.length>0) {
				survyes.forEach(function (s) {
					$ss= '<a href="./surveyQuestions.php?surveyid='+s['id']+'" class="list-group-item">'+s['name']+'</a>';
					$('#survyesList').append($ss);
				})
			}
		}
	</script>
</body>
</html>