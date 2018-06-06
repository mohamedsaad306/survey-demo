<?php 

/**
 * 
 */
class DBClient 
{
	var $connection;
	function __construct()
	{
 		# code...
		$this->connection = mysqli_connect(HOST, USER_NAME,	 PASSWORD, DB_NAME);
		$this->connection ->set_charset("utf8");
		//mysqli_select_db(DB_NAME);
		if (mysqli_connect_error(	)) {
			die("database connection error: " . mysql_errno());
		}
	}

	function CreateQuestion($questionStringEN,$questionStringAR, $surveyId ){		
		$query = "INSERT INTO questions (questionStringEN,questionStringAR, surveyId) VALUES ( '" . $questionStringEN . "' , '" . $questionStringAR . "' ,'".$surveyId."')";
		$result = mysqli_query($this->connection,$query);

		if (!$result) {
			die("Insertion Faield" . mysqli_error());
		} else {
			$questionId = mysqli_insert_id($this->connection);
			$this->CreateTypicalAnsweresForQuetion($questionId,$surveyId);
			print_r($result);
		}
	}

	function CreateSurvey($title){
		
		$query = "INSERT INTO `surveys`( `name`, `isPublished`) VALUES ( '".$title."' ,'1')";
		$result = mysqli_query($this->connection,$query);
		
		if (!$result) {
			die("Insertion Faield" . mysqli_error());
		} else {
			$last_id = mysqli_insert_id($this->connection);
			return $last_id;
		}
	}

	function CreateTypicalAnsweresForQuetion ($questionId,$surveyId){
		$query = "INSERT INTO `answers`(`answerString`, `questionId`, `surveyId`) VALUES ('Very Good','".$questionId."','".$surveyId."'),('Good','".$questionId."','".$surveyId."'),('Fair','".$questionId."','".$surveyId."'),('Poor','".$questionId."','".$surveyId."'),('Very Poor','".$questionId."','".$surveyId."')";
		
		$result = mysqli_query($this->connection,$query);
		if (!$result) {
			die("Insertion Faield" . mysqli_error());
		} else {
			print_r($result);
		}
	} 

	function GetSurvey($surveyId){
		$questionsQuery = "SELECT `id`, `questionStringEN`, `questionStringAR`, `surveyId` FROM `questions` WHERE `surveyId`='".$surveyId."'";
		// get questopns ids. 

		$answeresQuery= "SELECT * FROM `answers` WHERE `surveyId` IN (1,2)";

	}
	function GetSurveyQuetions($surveyId){

		$questionsQuery = "SELECT `id`, `questionStringEN`, `questionStringAR`, `surveyId` FROM `questions` WHERE `surveyId`='".$surveyId."'";

		$result = mysqli_query($this->connection,$questionsQuery);
		if (!$result) {
			die("Read Faield" . mysqli_error());
		} else {
			$results = array();
			while ($row=$result->fetch_assoc())
			{
				array_push($results, $row);
			}
			return$results;
		}
	}

	function GetSurveyData($surveyId){
		$questionsQuery = "SELECT * FROM `surveys` WHERE `id`='".$surveyId."'";
		$result = mysqli_query($this->connection,$questionsQuery);
		if (!$result) {
			die("Read Faield" . mysqli_error());
		} else {
			$results = array();
			while ($row=$result->fetch_assoc())
			{
				array_push($results, $row);
			}
			return$results;
		}
	}
}

?>
