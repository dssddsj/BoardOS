<?PHP

class output {
	
	var $content;
	
    function __construct($content) {
	$this->content = $content;
	$this->theme_path = "/../../themes/default/index.php";
	}
	
	public function footer() {
		return 'מופעל ע"י Board';
	}
	
	public function content() {
		echo $this->content;
	}
	
	public function getTheme($content) {
	global $content;
	ob_start();
	include $this->theme_path;
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	}
}

?>
