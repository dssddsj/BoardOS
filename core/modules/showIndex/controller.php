<?PHP

class showIndex extends engine {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
	}
	
	
	
	 function start() {
		// If showForum is defined
		if (strpos($_SERVER['REQUEST_URI'],'?') == false) {
		
		// Start new  Model
		$model_output = include "model.php";
		$model_output = new model;

		// Start new  View
		$view_output = include "view.php";
		$view_output = new view;
		
		 }
	}	

}

?>



