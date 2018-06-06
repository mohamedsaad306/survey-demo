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
				default:
			# code...
				break;
			}
		}		 
	}
		//$dbClient->CreateQuestion("English quetion ? ","سؤال بالعربيه ؟ ",1);
		// $dbClient->CreateSurvey("This iS a new survey");

	public function CreateSurvey(){
		
		if (isset($_POST["surveyName"])) {
			$surveyName =$_POST["surveyName"];
			$survyId  = $this->dbClient->CreateSurvey($surveyName);
			JReturn($survyId);
		}
		
	}

	function GetSurveyQuetions(){
		
		if (isset($_GET["surveyid"])) {
			$survyId  =$_GET["surveyid"];
			$quetions = $this->dbClient->GetSurveyQuetions($survyId);	
			JReturn($quetions);
		}
	}
	function GetSurveyData(){
		if (isset($_GET["surveyid"])) {
			$survyId  =$_GET["surveyid"];
			$quetions = $this->dbClient->GetSurveyData($survyId);	
			JReturn($quetions);
		}
	}
} #calss end egere 




function JReturn($value)
{
	echo json_encode($value);
}
?>
