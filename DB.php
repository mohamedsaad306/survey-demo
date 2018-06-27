<?php 

/**
 * 
 */
require_once("config.php");

class dbclient 
{
	var $connection;
	function __construct()
	{
 		# code...
		$this->connection = mysqli_connect(HOST, USER_NAME,	 PASSWORD, DB_NAME);
		$this->connection ->set_charset("utf8");
		//mysqli_select_db(db_name);
		if (mysqli_connect_error(	)) {
			die("database connection error: " . mysql_errno());
		}
	}
	function updateOldQuestions($_questions)
	{

		$questions = json_decode ($_questions,true);
		
		$sqlValues = "";
		foreach ($questions as $q) {
			$sqlValues .= "('".$q['questionId']."' ,'" .$q['enQuestion']. "' , '" . $q['arQuestion']. "'),";
		}
		$sqlValues=rtrim($sqlValues,",");

		 $sql= "insert into questions (id,questionstringen,questionstringar) values ".$sqlValues." ON DUPLICATE KEY UPDATE  questionstringen= VALUES(questionstringen),questionstringar=VALUES(questionstringar);";

		
		$result = mysqli_query($this->connection,$sql);
		if (!$result) {
			//echo $sql;
			die("insertion faield" . mysqli_error($this->connection));
		} else {
			return $sqlValues;
		}
	}

	function getSurveyComments($surveyId)
	{
		
		$sql = "SELECT `userId`, `comment` FROM `usersanswers` WHERE `surveyId` = ".$surveyId;

		$result = mysqli_query($this->connection,$sql);
		if (!$result) {
			die("read faield" . mysqli_error($this->connection));
		} else {
			$results = array();
			while ($row=$result->fetch_assoc())
			{
				array_push($results, $row);

			}
			return$results;
		}
	}

	function getSurveyQuestionsResults($surveyId)
	{

		$sql = "SELECT questions.questionStringEN, answers.answerString,answers.answerCount,questions.id as questionId FROM answers  INNER JOIN questions on questions.id =answers.questionId  WHERE answers.surveyId =".$surveyId;

		$result = mysqli_query($this->connection,$sql);
		if (!$result) {
			die("read faield" . mysqli_error($this->connection));
		} else {
			$results = array();
			while ($row=$result->fetch_assoc())
			{
				array_push($results, $row);

			}

			return$results;

		}	
	}
	function getAllSurveyesList()
	{
		$sql = "SELECT * FROM `surveys` WHERE 1";
		$result = mysqli_query($this->connection,$sql);
		if (!$result) {
			die("read faield" . mysqli_error($this->connection));
		} else {
			$results = array();
			while ($row=$result->fetch_assoc())
			{
				array_push($results, $row);
			}
			return$results;
		}
	}
	function submitClientAnswers($postData){
		// $data = json_decode($postData,true);
		$data =$postData;

		$clientId; 
		$surveyId;
		$comment;

		foreach ($data as $key => $value) {
			if ($key=='clientId') {
				$clientId = $value; 
			}elseif ($key=='surveyId') {
				$surveyId= $value;
			}else if ($key=='comment'){
				$comment= $value;
			}else {
				//key is question id , and value is answer value 
				$this->updateAnswer($key, $value);
			}
		}
		// save client submition to this survey to avoid submitting again 
		$saveId =  $this->saveClientSubmition($clientId,$surveyId,$comment);
		$result = ($saveId!=null);
		return $result;
	}
	function saveClientSubmition($clientId,$surveyId,$comment){
		$sql = "INSERT INTO `usersanswers` ( `userId`, `surveyId`,`comment`) VALUES ( '".$clientId."', '".$surveyId."' ,'".$comment."' );";
		$result = mysqli_query($this->connection,$sql);
		if (!$result) {
			die("insertion faield" . mysqli_error($this->connection));
		} else {
			$id= mysqli_insert_id($this->connection);
			return $id;
		}
	}

	function updateAnswer($questionId, $answerId){
	// update answeres where question id = 1 
		$sql = "UPDATE `answers` SET `answerCount`=`answerCount`+1 WHERE  `questionId` = '".$questionId."' and `id` =".$answerId."";

		$result = mysqli_query($this->connection,$sql);

		if (!$result) {
			//echo ;
			die($sql."__". mysqli_error($this->connection));
		} else {
			return true;
		}
	}


	function createNewQuestions($_questions)
	{
		$resultIds = [];
		$questions = json_decode ($_questions,true);
		foreach ($questions as $q) {
			print_r($questions);
			$questionid = $this->createquestion($q['enQuestion'],$q['arQuestion'], $q['surveyId'] );
			array_push($resultIds ,$questionid);
		}
		return $resultIds;
	}

	// function createNewQuestions($_questions)
	// {
	// 	$resultIds = [];
	// 	$questions = json_decode ($_questions,true);
	// 	foreach ($questions as $q) {
	// 		//print_r($questions);
	// 		$this->createquestion($q['enQuestion'],$q['arQuestion'], $q['questionId'] );
	// 		array_push($resultIds ,$questionid);
	// 	}
	// 	return $resultIds;
	// }



	function getSurveyQuestionsAnsweres($surveyId){
		$sql = "SELECT `id`, `answerString`, `questionId`, `surveyId` FROM `answers` WHERE `surveyId` ='".$surveyId."'";
		$result = mysqli_query($this->connection,$sql);
		if (!$result) {
			die("read faield" . mysqli_error($this->connection));
		} else {
			$results = array();
			while ($row=$result->fetch_assoc())
			{
				array_push($results, $row);
			}
			return$results;
		}
	}

	function validatePrevouslySubmittedSurvey($surveyId,$clientId){
		$sql = "SELECT `userId`, `surveyId` FROM `usersanswers` WHERE `userId` ='".$clientId."' and `surveyId` ='".$surveyId."'";
		$result = mysqli_query($this->connection,$sql);
		if (!$result) {
			die("read faield" . mysqli_error($this->connection));
		} else {
			$results = array();
			while ($row=$result->fetch_assoc())
			{
				array_push($results, $row);
			}
			return$results;
		}
	}

	function createquestion($questionstringen,$questionstringar, $surveyid ){		
		$query = "insert into questions (questionstringen,questionstringar, surveyid) values ( '" . $questionstringen . "' , '" . $questionstringar . "' ,'".$surveyid."')";
		$result = mysqli_query($this->connection,$query);

		if (!$result) {
			die("insertion faield" . mysqli_error($this->connection));
		} else {
			$questionid = mysqli_insert_id($this->connection);
			$this->createtypicalansweresforquetion($questionid,$surveyid);
			//print_r($result);
			return $questionid;
		}

	}

	function createsurvey($title){

		$query = "insert into `surveys`( `name`, `ispublished`) values ( '".$title."' ,'1')";
		$result = mysqli_query($this->connection,$query);

		if (!$result) {
			die("insertion faield" . mysqli_error($this->connection));
		} else {
			$last_id = mysqli_insert_id($this->connection);
			return $last_id;
		}
	}

	function createtypicalansweresforquetion ($questionid,$surveyid){
		$query = "insert into `answers`(`answerstring`, `questionid`, `surveyid`) values ('very good','".$questionid."','".$surveyid."'),('good','".$questionid."','".$surveyid."'),('fair','".$questionid."','".$surveyid."'),('poor','".$questionid."','".$surveyid."'),('very poor','".$questionid."','".$surveyid."')";

		$result = mysqli_query($this->connection,$query);
		if (!$result) {
			die("insertion faield" . mysqli_error($this->connection));
		} else {
			print_r($result);
		}
	} 

	function getsurvey($surveyid){
		$questionsquery = "select `id`, `questionstringen`, `questionstringar`, `surveyid` from `questions` where `surveyid`='".$surveyid."'";
		// get questopns ids. 

		$answeresquery= "select * from `answers` where `surveyid` in (1,2)";

	}
	function getsurveyquetions($surveyid){

		$questionsquery = "select `id`, `questionstringen`, `questionstringar`, `surveyid` from `questions` where `surveyid`='".$surveyid."'";

		$result = mysqli_query($this->connection,$questionsquery);
		if (!$result) {
			die("read faield" . mysqli_error($this->connection));
		} else {
			$results = array();
			while ($row=$result->fetch_assoc())
			{
				array_push($results, $row);
			}
			return$results;
		}
	}

	function getsurveydata($surveyid){
		$questionsquery = "select * from `surveys` where `id`='".$surveyid."'";
		$result = mysqli_query($this->connection,$questionsquery);
		if (!$result) {
			die("read faield" . mysqli_error($this->connection));
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
