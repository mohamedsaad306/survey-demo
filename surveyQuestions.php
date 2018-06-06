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
		
		<div id="survey" data-id="" >
			<h3 id="survey-name"> </h3>
			<button id="add-question" class="btn btn-primary">Add Question</button>
			<button id="save-survey" class="btn btn-primary">Save</button>

			<div id="questions" class="col-md-6">
			</div>
		</div>

	</div>
	<script type="text/javascript">

		var addNewQuestionsCount =0;
		$(document).ready(function (){
			var surveyid = getParameterByName('surveyid');
			if (surveyid) {
				var surveyData = getSurveyData(surveyid,setSurveyData);
				var surveyQuetions = getSurveyQuestions(surveyid,RenderQuestions);
			}
			$("[data-deleteId]").click(deleteQuestion);
		});// end ready 


		$('#save-survey').click(saveSurvey);
		function saveSurvey() {
			// get new questions

			// post to server  
		}

		$('#add-question').click(addNewQuestion);
		function addNewQuestion (){
			$question = `<div class=" well">
			<div class="form-group" >
			<label for="englishQuestion-new-`+addNewQuestionsCount+`">English Question <span class="label label-success">New</span> </label> 
			<input type="text" class="form-control" id="englishQuestion-new-`+addNewQuestionsCount+`" value=""  name="englishQuestion" data-id="">
			</div>
			<div class="form-group">
			<label for="arabicQuestion-new-`+addNewQuestionsCount+`">Arabic Question</label>
			<input type="text" class="form-control" id="arabicQuestion-new-`+addNewQuestionsCount+`" placeholder="English Question" name="arabicQuestion" data-id=""  value="">
			</div>
			<span class="btn btn-danger" data-deleteId>Remove </span>
			</div>`;
			$('#questions').prepend($question);
			$("[data-deleteId]").click(deleteQuestion);
			addNewQuestionsCount++;
		}

		function deleteQuestion() {
			console.log($(this).parent());
			var questionIdToRemove =$(this).data('deleteid');
			console.log(questionIdToRemove); 
			if (questionIdToRemove!="") {
				if (confirm("Please note that all related answeres will be delete, are you sure you sure you want to delete ?")) {
					$(this).parent().remove();
				}

			}else{
				$(this).parent().remove();
			}
		}

		function RenderQuestions(questionsArray) {

			questionsArray = JSON.parse(questionsArray);
			// 	console.log("data");

			questionsArray.forEach(function(q){
				console.log(q);
				$question = `<div class=" well">
				<div class="form-group">

				<label for="englishQuestion-`+q['id']+`">English Question </label>
				<input type="text" class="form-control" id="englishQuestion-`+q['id']+`" value="`+q['questionStringEN']+`"  name="englishQuestion" data-id="`+q['id']+`">
				</div>

				<div class="form-group">
				<label for="arabicQuestion-`+q['id']+`">Arabic Question</label>
				<input type="text" class="form-control" id="arabicQuestion-`+q['id']+`" placeholder="English Question" name="arabicQuestion" data-id="`+q['id']+`"  value="`+q['questionStringAR']+`">
				</div>
				<span class="btn btn-danger" data-deleteId="`+q['id']+`">Remove </span>
				</div	>`;
				$('#questions').append($question);
			});
			$("[data-deleteId]").click(deleteQuestion);
		}

		function getSurveyQuestions(surveyid,successCallback){
			var result ; 
			
			var $form = $(this);
			var $inputs = $form.find("input, select, button, textarea");
			var serializedData = $form.serialize();
			$inputs.prop("disabled", true);

			request = $.ajax({
				url: "api.php?action=GetSurvey&surveyid="+surveyid,
				type: "GET",
				data: serializedData
			});


			request.done(function (response, textStatus, jqXHR){
			        // Log a message to the console
			       // console.log(response);
			        // alert(response);
			        
			        result = response;
			        if (successCallback) {
			        	successCallback(result);
			        }
			    });

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+textStatus, errorThrown	
					);
			});

			request.always(function () {
			        // Reenable the inputs
			        $inputs.prop("disabled", false);
			    });		
			return result;
		}

		function setSurveyData(data) {
			$('#survey').data('id', JSON.parse(data)[0]['id']);			
			$('#survey-name').text("Survey Name: "+ JSON.parse(data)[0]['name']);			
			// console.log(JSON.parse(data)[0]['id']);
		}

		function getSurveyData(surveyid,successCallback) {
			var result;
			request = $.ajax({
				url: "api.php?action=GetSurveyData&surveyid="+surveyid,
				type: "GET",
				//data: serializedData
			});

			request.done(function (response, textStatus, jqXHR){

				result = response;
				if (successCallback) {
					successCallback(result);
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+textStatus, errorThrown	
					);
			});


			return result;
		}
	</script>
</body>
</html>


<!-- Sample -->
<!-- <div class="col-md-6 well">
			<div class="form-group">
				<label for="englishQuestion">English Question </label>
				<input type="text" class="form-control" id="englishQuestion"   name="englishQuestion" data-id="1">
			</div>

			<div class="form-group">
				<label for="arabicQuestion">Arabic Question</label>
				<input type="text" class="form-control" id="arabicQuestion" placeholder="English Question" name="arabicQuestion" data-id="2"  value="This is a value ">
			</div>
		</div>	 -->