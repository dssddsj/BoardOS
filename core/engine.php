<?PHP

session_start();


//Include loader
include "loader.php";

//Include Handlers
include dirname(__FILE__) . "/handlers/db_handler.php";
include dirname(__FILE__) . "/handlers/output_handler.php";
include dirname(__FILE__) . "/handlers/date_handler.php";
include dirname(__FILE__) . "/handlers/forum_handler.php";
include dirname(__FILE__) . "/handlers/error_handler.php";

//Include Libaries
include dirname(__FILE__) . "/libraries/htmlpurifier/library/HTMLPurifier.auto.php";




class engine {
			
	public function __construct() {
	
	// Set global Vars	
	global $output, $db, $host, $user, $pass, $db_name;
	
	// New DB PDO Connection
	$this->db = new db(array($host, $user, $pass, $db_name));
	$db = $this->db ;
	
	// Get first get var
	$this->_get = array_keys($_GET);
	
	// New Date Handler
	$this->date_handler = new date;
	
	// New Date Handler
	$this->error_handler = new error;
	
	// New Forum Handler
	$this->forum_handler = new forum();
	
	// New HTML Purfifier
	$config = HTMLPurifier_Config::createDefault();
    $this->html_purifier = new HTMLPurifier($config);
	
	 }
	 	 	 

	public function start() {
		$load = new loader();
	}
		 
	
	//$model->showTheme($content);
	 }

?>



