<?php 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Servey System</title>
	<!-- <link href="css/bootstrap-Sandstone.min.css" rel="stylesheet" /> -->
	<link href="css/bootstrap.css" rel="stylesheet" />
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/utils.js"></script>
</head>

<body>
	<br>
	<div class="container ">
		<div id="info">	
		</div>
		<div id="survey" data-id="" >
			<h3 id="survey-name"> </h3>
			<div id="questions" class="col-md-6">
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function (){
			getClientSurvey();
		});


		function getClientSurvey() {
			var clientId = getParameterByName('clientId');
			var surveyId = getParameterByName('surveyId');
			if (!surveyId ||!clientId ) {				
				$('#info').append('<div class="alert alert-warning" role="alert"> incorrect survey url, please contact System administrator.</div>');
				return;
			}
			// check if user has previously submitted this survey.
			var isPrevouslySubmitted= validatePrevouslySubmittedSurvey(clientId,surveyId);
			
			if (!isPrevouslySubmitted) {
				// get and display survey.
				alert(isPrevouslySubmitted);
			}else{
				$('#info').append('<div class="alert alert-success" role="alert"> Thanks for your precious giving us your feedback, Survey submitted successfully.</div>');
			}

		}

		function validatePrevouslySubmittedSurvey(clientId,surveyId) {
			var req = $.ajax({
				url: "api.php?action=validatePrevouslySubmittedSurvey&surveyId="+surveyId+"&clientId="+clientId,
				type: "GET",
				async: false,
			}).responseText;

			result = JSON.parse(req);
			result = (result.length>0); 
			return result;
		}
	</script>
</body>
</html>