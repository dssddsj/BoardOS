<?PHP

class edit extends engine {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
	}
	
	function start() {
		// If showForum is defined
		if (isset($_GET[get_class($this)])) { 
		
		if ($_GET[get_class($this)] == "thread") {$module = "thread";}
		else if ($_GET[get_class($this)] == "post") {$module = "post";}
		else if ($_GET[get_class($this)] == "user") {$module = "user";}
		
		if (isset($module)) {
			
		$model_file = dirname(__FILE__)."/".$module."_model.php";
		$view_file = dirname(__FILE__)."/".$module."_view.php";
			
		if (file_exists($model_file)) {	
		// Start new  Model
		$model_output = include $model_file;
		$model_output = new model;
		}

        if (file_exists($view_file)) {	
		// Start new  View
		$view_output = include $view_file;
		$view_output = new view;
		}
	
		}
		
		 }
	}	
}
	
	

?>



