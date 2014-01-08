<?PHP

class view extends act {	
	
	public function __construct() {
		
		// Get engine construct vars
		parent::__construct();
		global $msg;
		echo $msg;
		$this->forum_handler->redirect('index.php');	
		
		
		
		
	}
}

?>



