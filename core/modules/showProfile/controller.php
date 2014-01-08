<?PHP

class showProfile extends engine {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
	}
	
	
	
	 function start() {
		// If showForum is defined
		if (isset($_GET[get_class($this)]) && ($this->_get[0] = get_class($this))) { 
		
		// Start new  Model
		$model_output = include "model.php";
		$model_output = new model;
		
		// Get model vars
		
		// Start new  View
		$view_output = include "view.php";
		$view_output = new view;
		
		 }
	}	

}

?>



