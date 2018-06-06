<?php 

require_once("config.php");
require_once("db.php");
require_once("api.php");

$controller = new apiController;
$controller->Dispatch();
/**
* 
 done 
-	create survey 
- 	create survey quetions 
-	submit answer   

 todo
- 	 html craete survy 
-	 html results 
-	 cient html submit answers

*/
class apiController {
	
	var $dbClient;
	
	function __construct()
	{
		# code...
		$this->dbClient = new DBClient;
	}
	
	function Dispatch(){
		if (isset($_GET["action"])) {
			switch ($_GET["action"]) {
				case 'createSurvey':
				$this->createsurvey();
				break;
				case 'GetSurvey':
				$this->GetSurveyQuetions();
				break;
				case 'GetSurveyData':
				$this->GetSurveyData();
				break;

				case 'validatePrevouslySubmittedSurvey':
				$this->validatePrevouslySubmittedSurvey();
				break;
				
				default:
			# code...
				break;
			}
		}		 
	}

	function validatePrevouslySubmittedSurvey(){
		if (isset($_GET['surveyId']) && isset($_GET['clientId']) ) {
			$surveyId =$_GET['surveyId'];
			$clientId =$_GET['clientId'];
			$result = $this->dbClient->validatePrevouslySubmittedSurvey($surveyId,$clientId);
			JReturn($result);
		}
	}
	
	function GetSurveyData(){
		if (isset($_GET["surveyid"])) {
			$survyId  =$_GET["surveyid"];
			$quetions = $this->dbClient->GetSurveyData($survyId);	
			JReturn($quetions);
		}
	}
	function GetSurveyQuetions(){
		
		if (isset($_GET["surveyid"])) {
			$survyId  =$_GET["surveyid"];
			$quetions = $this->dbClient->GetSurveyQuetions($survyId);	
			JReturn($quetions);
		}
	}

	function CreateSurvey(){
		
		if (isset($_POST["surveyName"])) {
			$surveyName =$_POST["surveyName"];
			$survyId  = $this->dbClient->CreateSurvey($surveyName);
			JReturn($survyId);
		}		
	}

	
	
} #calss end egere 




function JReturn($value)
{
	echo json_encode($value);
}
?>
