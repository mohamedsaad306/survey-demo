
<?php 
require_once("router.php");
require_once("config.php");
require_once("db.php");
require_once("api.php");

echo "This Is App Home";
$app = new App;
$app->Main();

/**
* 	application entry point.
*/
class App 
{
	
	function __construct()
	{
	}

	function Main(){
		$router = new Router;
		$router->Route($_SERVER);
	}
	
}

 ?>