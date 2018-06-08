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
			<option  value="en" >English</option>
			<option value="ar" selected>العربية</option>
		</select>

		<div id="survey" data-id="" data-clientId="" >
			<h3 id="survey-name"></h3>
			<div id="questions" class="col-md-6">

				<div class="form-group">

					

				</div>
			</div>
		</div>
		<script type="text/javascript">

			$(document).ready(function (){
				getClientSurvey();
				$('#selectedLanguage').on('change',changeLanguage);
			});

			function changeLanguage(){
				
				$('[data-questionLang]').css('display','none'); 
				$('[data-questionLang|='+this.value+']').css('display','block');	 
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
					1	
				// render questions.
				if (surveyQuestions && surveyQuestions.length>0) {
					var surveyAnsweres = getSurveyQuestionsAnsweres(surveyId);
					renderQuestions(surveyQuestions,surveyAnsweres);
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
			console.log("answer");
			console.log(surveyAnsweres);
			surveyQuestions.forEach(function(q){


				var answersValues =[];
				surveyAnsweres.forEach(function(a){

					if (a['questionId']== q['id']) {
						switch (a['answerString']) {
							case 'very good':
							var t ={answerId:a['id'],englishString:"Very Good", arabicString:"جيد جدا" };
							answersValues.push(t);
							break;


							case 'good':
							var t ={answerId:a['id'],englishString:"Good", arabicString:"جيد" };
							answersValues.push(t);
							break;
							case 'fair':
							var t ={answerId:a['id'],englishString:"Fair", arabicString:"مقبول" };
							answersValues.push(t);
							break;
							case 'poor':
							var t ={answerId:a['id'],englishString:"Poor", arabicString:"ضعيف" };
							answersValues.push(t);
							break;
							case 'very poor':
							var t ={answerId:a['id'],englishString:"Very Poor", arabicString:"ضعيف جدا" };
							answersValues.push(t);
							break;
							default:
							break;
						}
					}
				});
				//	console.log(answersValues);

				$question = `<div id="question-`+q['id']+`" >
				<div id= "question-`+q['id']+`" class="form-group"  data-questionLang="en" data-questionId="" style="display: none;">
				<h4>`+q['questionstringen']+`</h4>
				<div class="radio-inline">
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[0]['answerId']+`" >
				`+answersValues[0]['englishString']+`
				</label>
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[1]['answerId']+`" >
				`+answersValues[1]['englishString']+`
				</label>
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[2]['answerId']+`" >
				`+answersValues[2]['englishString']+`
				</label>
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[3]['answerId']+`" >
				`+answersValues[3]['englishString']+`
				</label>
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[4]['answerId']+`" >
				`+answersValues[4]['englishString']+`
				</label>
				</div>
				</div>
				</div>
				<div id= "question-`+q['id']+`" class="form-group"  data-questionLang="ar" data-questionId="" style="display: block;">
				<h4>`+q['questionstringar']+`</h4>
				<div class="radio-inline">
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[0]['answerId']+`" >
				`+answersValues[0]['arabicString']+`
				</label>
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[1]['answerId']+`" >
				`+answersValues[1]['arabicString']+`
				</label>
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[2]['answerId']+`" >
				`+answersValues[2]['arabicString']+`
				</label>
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[3]['answerId']+`" >
				`+answersValues[3]['arabicString']+`
				</label>
				<label class="radio-inline">
				<input type="radio" name="answer-`+q['id']+`" id="answer-`+q['id']+`" value="`+answersValues[4]['answerId']+`" >
				`+answersValues[4	]['arabicString']+`
				</label>
				</div>
				</div>
				</div>
				`

				$("#questions").append($question);
			});
		}
	</script>
</body>
</html>