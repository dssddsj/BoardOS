<?PHP

class model extends act {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
		
		global $msg, $db;
		
		if (isset($_SESSION['username'])) { 
		unset($_SESSION['username']);
		session_destroy();
		$msg = "Logout success";
		}
		
		else {
		$msg = "Your not logged in";
		}
		
}
}

?>



