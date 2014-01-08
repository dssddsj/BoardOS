<?PHP

//Include Configs
include "config.php";

/*
include "/modules/showForum/controller.php";
include "/modules/showIndex/controller.php";
include "/modules/showThread/controller.php";
include "/modules/showProfile/controller.php";
*/

function __autoload($class_name) {
include dirname(__FILE__) . '/modules/'.$class_name . '/controller.php';
}

class loader {
	

function __construct() {
$controller = new showForum();
$controller->start();
		
$controller = new showIndex();
$controller->start();
		
$controller = new showThread();
$controller->start();
		
$controller = new showProfile();
$controller->start();

$controller = new act();
$controller->start();

$controller = new add();
$controller->start();

$controller = new search();
$controller->start();

$controller = new edit();
$controller->start();
}
}


?>



