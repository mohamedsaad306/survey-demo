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

		<div class="row">
			<div class="col-md-6">
				<form action="#" method="POST" id= "submit-survey">
					<div class="form-group ">
						<div class="form-group ">
							<label for="surveyName"><h4>New survey name</h4> </label>
							<input type="text" class="form-control " id="surveyName" name="surveyName" placeholder="Survey Name" required="">
						</div>
						<button type="submit" value="submit" class="btn btn-primary">Create</button>
					</div>
				</form>
			</div>

			<div class="col-md-6 form-horizontal">
				<!-- <div class="col-md-6 form-inline "> -->
					<label for="surveyName"><h4>Generate Client Link </h4> </label>
					<br>
					<div class="row">
						
						<div class="col-xs-4">
							<label for="clientId"><!-- <h4> -->Client Id <!-- </h4> --> </label>
							<input type="text" class="form-control" id="clientId" name="clientId" placeholder="" required="">
						</div>
						<div class="col-xs-6">
							<label for="surveys-dropDown"><!-- <h4> -->Survey<!-- </h4> --> </label>
							<select class="form-control" id= "surveys-dropDown">
								
							</select>
						</div>
						<div class="col-xs-2">
							<label for="generateBtn">    </label>
							<button id="generateBtn" class="btn btn-default">Generate</button>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<!-- <label for="clientUrl"><h4>Client URL <!-- </h4> --> </label> 
							<br>
							<input id="clientUrl"  class="form-control" type="text" placeholder="Client URL ... ">
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="list-group" id="survyesList">
				</div>
			</div>



		</div>
		<script type="text/javascript">
			$(document).ready(function () 
			{
				var survyes= getAllSurveyes();
				if (survyes) 
					renderSurveyesList(survyes);
				renderSurveyesDropDown(survyes);

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

			function renderSurveyesDropDown(survyes) {
				if (survyes.length>0) {
					survyes.forEach(function (s) {
						$ss= '<option value ='+s['id']+' >'+s['name']+'</option>';
						$('#surveys-dropDown').append($ss);
					})
				}
			}
			function getAllSurveyes() {
				var req = $.ajax({
					url: "api.php?action=getAllSurveyesList",
					type: "GET",
					async: false,
				}).responseText;

				result = JSON.parse(req);

				return result;
			}
			function renderSurveyesList(survyes) {
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