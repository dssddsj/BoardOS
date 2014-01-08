<?PHP

class view extends add {
function __construct() {
	parent::__construct();
	
	 if (!isset($_SESSION['username'])) {echo 'אתה חייב להיות מחובר על מנת לפתוח אשכולות חדשים. אנא <a data-toggle="modal" href="#login">התחבר למערכת</a>';}
	 else {
	$post_threads_pre =  $this->forum_handler->getPermissions($_GET['forum'], 'post_thread');
	if ($post_threads_pre == 1) {
		$this->error_handler->show(404, "אינך רשאי לפרסם אשכולות בפורום הזה.");
		}
	echo '
	<h1 class="forum-title">פתיחת אשכול חדש
</h1>
    <form style="background:#FFF; padding:10px 10px 55px 10px;" action="?add=thread" method="POST">
	<input type="text" name="title" class="form-control" placeholder="כותרת האשכול" required>
	<br />
	<textarea name="content" class="ckeditor" rows="3" placeholder="תוכן האשכול" required></textarea>
	<input type="hidden" name="forum-id" value="'.$_GET['forum'].'">
	<input type="submit" value="פרסם אשכול" class="btn btn-primary" style="float:left; margin-top:10px;">
	</form>
	';
	 }
}
}


?>



