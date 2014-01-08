<?PHP

class view extends act {	
	
	public function __construct() {
		parent::__construct();
		global $post;
		
		if(isset($post['id'])) {
			echo '
	<h1 class="forum-title">עריכת הודעה</h1>
    <form style="background:#FFF; padding:10px 10px 55px 10px;" action="?edit=post" method="POST">
	<textarea name="content" class="ckeditor" rows="3" placeholder="תוכן ההודעה" required>'.$post['content'].'</textarea>
	<input type="hidden" name="post-id" value="'.$post['id'].'">
	<input type="submit" value="ערוך הודעה" class="btn btn-primary" style="float:left; margin-top:10px;">
	
	</form>
';
		}

}

}

?>



