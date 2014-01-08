<?PHP

class view extends act {	
	
	public function __construct() {
		parent::__construct();
		global $thread;
		
		if(isset($thread['id'])) {
			echo '
			
	<h1 class="forum-title">עריכת אשכול</h1>
    <form style="background:#FFF; padding:10px 10px 55px 10px;" action="?edit=thread" method="POST">
	<input type="text" name="title" class="form-control" placeholder="כותרת האשכול" value="'.$thread['title'].'" required><br />
	<textarea name="content" class="ckeditor" rows="3" placeholder="תוכן האשכול" required>'.$thread['content'].'</textarea>
	<input type="hidden" name="thread-id" value="'.$thread['id'].'">
	<input type="submit" value="ערוך אשכול" class="btn btn-primary" style="float:left; margin-top:10px;">
	
	</form>
';
		}

}

}

?>



