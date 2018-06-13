<!DOCTYPE HTML>
<html>
<head>
	<!-- <link href="css/bootstrap.css" rel="stylesheet" /> -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/utils.js"></script>
	<script src="js/jquery.canvasjs.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
	<link href="css/bootstrap.css" rel="stylesheet" />
	
	<script>
		// window.onload = function () {

		// 	var options = {

		// 		animationEnabled: true, 
		// 		axisY: { includeZero: true	},	
		// 		title: {
		// 			text: "Chart inside a jQuery Resizable Element"
		// 		},
		// 		data: [{
		// 			type: "column",
		// 			yValueFormatString: "#,##0.0#"%"",
		// 			dataPoints: [
		// 			{ label: "Iraq", y: 120 },	
		// 			{ label: "Turks & Caicos Islands", y: 0 },	
		// 			{ label: "Nauru", y: 0 },
		// 			{ label: "Ethiopia", y: 0 },	
		// 			{ label: "Uzbekistan", y: 80 },					
		// 			]
		// 		}]
		// 	};
		// 	$("#chartContainer").CanvasJSChart(options);
		// 	$("#chartContainer2").CanvasJSChart(options);

		// }
	</script>

</head>
<body>
	<div class="container">
		<ul class="nav nav-pills" role="tablist">
			<li role="presentation" ><a href="./surveys.php" aria-controls="home" >Surveys </a></li>
		</ul>
		<!-- <div class="col-md-6 py-1">
			<div class="card">
				<div class="card-body">
					<canvas id="chBar"></canvas>
				</div>
			</div>
		</div> -->
		<div id="survey" data-id="">
			<h3 id="survey-name"> </h3>
		<!--<div id="chartContainer3" style="height: 300px; width: 100%;"></div>					
			<div id="chartContainer" style="height: 300px; width: 100%;"></div>					
			<div id="chartContainer2" style="height: 300px; width: 320px;"></div>
		-->
	</div>

	<script type="text/javascript">
		$(document).ready(function (){
			var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];


			var surveyId = getParameterByName('surveyId');
			console.log(surveyId);

			if (surveyId) {
				$('#survey').data('surveyId',surveyId);
				var surveyData = getSurveyData(surveyId,setSurveyData);
				var surveyQuetions = getSurveyQuestionsResults(surveyId,RenderQuestionsResults);
			}

		});
		function getSurveyQuestionsResults(surveyId,callBack){
			var result;
			request = $.ajax({
				url: "api.php?action=getSurveyQuestionsResults&surveyId="+surveyId,
				type: "GET",
				success:function(response){
					// console.log(JSON.parse(response));
					if (callBack) {
						callBack(JSON.parse(response));
					}
				}

			});
		}
		function setSurveyData(data) {
			$('#survey').data('id', JSON.parse(data)[0]['id']);			
			$('#survey-name').text("Survey Name: "+ JSON.parse(data)[0]['name']);			
			// console.log(JSON.parse(data)[0]['id']);
		}

		function RenderQuestionsResults(data){
			console.log('asd');
			console.log(data);
			var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
			var questions = [];			

			for (var i = 0; i < data.length; i++) {
				if (questions.indexOf(data[i]['questionId']) < 0 ) {
					questions.push(data[i]['questionId']);
					
					var devId= 'chart-'+data[i]['questionId'];
					
					// $div = '<div id="'+devId+'" style="height: 300px;"></div>';
					$div = `<div class="col-md-6 py-1">
					<div class="card">\
					<div class="card-body">\
					<h4>`+data[i]['questionStringEN']+`</h4>
					<canvas id="`+devId+`"></canvas>\
					</div>\
					</div>\
					</div>`;

					$('#survey').append($div);
					// console.log(data[i]['questionId']);
					var chBar = document.getElementById(devId);
					var counts = [];
					for (var k = 0; k < data.length; k++) {
						if (data[k]['questionId']==data[i]['questionId']) {
							switch (data[k]['answerString']) {
								case 'very good':
								counts[0]=data[k]['answerCount'];
								break;
								case 'good':
								counts[1]=data[k]['answerCount'];
								break;
								case 'fair':
								counts[2]=data[k]['answerCount'];
								break;
								case 'poor':
								counts[3]=data[k]['answerCount'];
								break;
								case 'very poor':
								counts[4]=data[k]['answerCount'];
								break;
							}
						}
					} 
					if (chBar) {
						new Chart(chBar, {
							title:"asd",
							type: 'bar',
							data: {
								labels: ["Very Good", "Good", "Fair", "Poor", "Very Poor"],
								datasets: [{
									data: counts,
									backgroundColor: colors[0]
								}]
							},
							options: {
								legend: {
									display: false
								},
								scales: {
									xAxes: [{
										barPercentage: 0.4,
										categoryPercentage: 0.5
									}]
								}
							}
						});
					}//end if 
				}
			}

			
			
			// var questions = [];
			// for (var i =0 ;i< questions.length ; i++) {
			// 	$div = '<div id="chartContainer'+i+'" style="height: 300px; width: 100%;"></div>'

			// 	var chart = new CanvasJS.Chart("chartContainer"+i, {
			// 		width:320,
			// 		title:{text:"asd"},
			// 		data: [
			// 		{
			// 			dataPoints: [
			// 			{ x: 10, y: 50 },
			// 			{ x: 20, y: 40},
			// 			{ x: 30, y: 30 },
			// 			{ x: 40, y: 80 },
			// 			{ x: 50, y: 20 },
			// 			]
			// 		}
			// 		]
			// 	});
			// 	chart.render();

			// }
		}

	</script>
</body>
</html>