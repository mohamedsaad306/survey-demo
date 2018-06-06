	<?php 
require('vendor/autoload.php');	
require_once("api.php");
use \NoahBuscher\Macaw\Macaw;

Macaw::get('/survey', function (){});	
Macaw::get('/survey/', function (){});	

// Macaw::post('/survey/api/CreateSurvey',"apiController@CreateSurvey");
Macaw::post('/survey/api/CreateSurvey', function() {return "Ajax";}); 

Macaw::get('/survey/api/SubmitSurvey', 
	function (){echo "SubmitSurvey";});

Macaw::get('/survey/api/',
	function (){echo "api";});


Macaw::get('view/(:num)', 'Controllers\demo@view');
 
Macaw::error(function() {
 // echo '404 :: Not Found';
});

Macaw::dispatch();
?>