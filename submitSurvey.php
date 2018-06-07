<!DOCTYPE html>
<html>
<head>
	<title>Servey System</title>
	<!-- <link href="css/bootstrap-Sandstone.min.css" rel="stylesheet" /> -->
	<link href="css/bootstrap.css" rel="stylesheet" />
	<link href="css/font-awesome.min.css" rel="stylesheet" />
	<link href="css/loader.css" rel="stylesheet" />
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/utils.js"></script>

</head>

<body>
	<br>
	<div class="container ">
		<div id="info">	
		</div>
		<select class="form-control" id="selectedLanguage" data-width="fit">
			<option  value="en">English</option>
			<option value="ar" >العربية</option>
		</select>

		<div id="survey" data-id="" data-clientId="" >
			<h3 id="survey-name"></h3>
			<div id="questions" class="col-md-6">

				<div class="form-group">

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
				

				<div id= "qq" class="form-group"  data-questionLang="ar" data-questionId="" style="display: none;">
					
					<h4>This is a quetion  2 </h4>
					<div class="radio-inline">
						
						<label class="radio-inline">
							<input type="radio" name="optionsRadios1" id="optionsRadios2" value="option1" checked>
							Very Good
						</label>

						<label class="radio-inline">
							<input type="radio" name="optionsRadios1" id="optionsRadios2" value="option1" checked>
							Good
						</label>

						<label class="radio-inline">
							<input type="radio" name="optionsRadios1" id="optionsRadios2" value="option1" checked>
							Fair
						</label>

						<label class="radio-inline">
							<input type="radio" name="optionsRadios1" id="optionsRadios2" value="option1" checked>
							Poor
						</label>

						<label class="radio-inline">
							<input type="radio" name="optionsRadios1" id="optionsRadios2" value="option1" checked>
							Very Poor 
						</label>
					</div>

				</div>


			</div>
		</div>
	</div>
	<script type="text/javascript">

		$(document).ready(function (){
			getClientSurvey();
			$('#selectedLanguage').on('change',changeLanguage);
		});

		function changeLanguage(){
			alert('language changed '+this.value);
			// clear selected answeres. 
		}

		function getClientSurvey() {
			var clientId = getParameterByName('clientId');
			var surveyId = getParameterByName('surveyId');
			if (!surveyId ||!clientId ) {				
				$('#info').append('<div class="alert alert-warning" role="alert"> incorrect survey url, please contact System administrator.</div>');
				return;
			}

			// check if user has previously submitted this survey.
			if (!validatePrevouslySubmittedSurvey(clientId,surveyId)) {				
				var surveyQuestions = getSurveyQuestions(surveyId);
					// set client id data attribute for submit.
					// set survey id data attribute for submit. 

				// render questions.
				if (surveyQuestions && surveyQuestions.length>0) {
					var surveyAnsweres = getSurveyQuestionsAnsweres(surveyId);
					renderQuestions(surveyQuestions,surveyQuestions);
				}
			}
			else
			{
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

		function getSurveyQuestions(surveyId){
			var req = $.ajax({
				url: "api.php?action=GetSurvey&surveyId="+surveyId,
				type: "GET",
				async: false,
			}).responseText;
			result = JSON.parse(req);
			//result = (result.length>0);
			console.log(result); 
			return result;	
		}
		function getSurveyQuestionsAnsweres(surveyId){
			var req = $.ajax({
				url: "api.php?action=getSurveyQuestionsAnsweres&surveyId="+surveyId,
				type: "GET",
				async: false,
			}).responseText;
			result = JSON.parse(req);
			//result = (result.length>0);
			console.log(result); 
			return result;	
		}
		function renderQuestions(surveyQuestions,surveyAnsweres){
			
			surveyQuestions.forEach(function(q){


			});
		}
	</script>
</body>
</html>