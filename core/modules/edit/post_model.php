<?PHP

class model extends search {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
		global $db, $post;
		
		if (isset($_GET['id'])) {
		
		if (isset($_SESSION['username'])) {
		$post_id = $_GET['id'];
		$post_content = $db ->Get(1,"posts", 'id', $post_id, 'content'); 
		$post_author_id = $db ->Get(1,"posts", 'id', $post_id, 'user');
		if (count($post_content) == 0){ 
		$this->error_handler->show("לא ניתן לערוך הודעה", "לא ניתן לערוך את ההודעה שבחרתה מכיוון שהיא אינה קיימת.");
	 }
		else {
			if ($_SESSION['username'] == $post_author_id[0]) {
				// If user owns the post
				$post['id'] = $post_id;
				$post['content'] = $post_content[0];
		}
	else {
	 $this->error_handler->show("ההודעה שאתה מנסה לערוך אינה שלך.", "ההודעה שאתה מנסה לערוך אינה שלך ולכן אינך יכול לערוך אותה.");
	}
	
	}
	
	}
	else {
	$this->error_handler->show("עליך להתחבר למערכת.", "עליך להתחבר למערכת על מנת לערוך תגובות");
	}
	
		
	}
	
	if (isset($_POST['post-id'])) {
		if (isset($_SESSION['username'])) {
		$post_id = $_POST['post-id'];
		$post_content = $db ->Get(1,"posts", 'id', $post_id, 'content'); 
		$post_author_id = $db ->Get(1,"posts", 'id', $post_id, 'user');
		if (count($post_content) == 0){ $this->error_msg = "";
	$this->error_handler->show("לא ניתן לערוך הודעה", "לא ניתן לערוך את ההודעה שבחרתה מכיוון שהיא אינה קיימת.");
	}
		else {
			if ($_SESSION['username'] == $post_author_id[0]) {
				$post_content = $_POST['content'];
				$db -> Edit("posts", "content" ,$post_content, $post_id);
				$thread_id = $db ->Get(1,"posts", 'id', $post_id, 'thread'); 
				$this->forum_handler->redirect('?showThread='.$thread_id[0]);
			}
			else {
    $this->error_handler->show("ההודעה שאתה מנסה לערוך אינה שלך.", "ההודעה שאתה מנסה לערוך אינה שלך ולכן אינך יכול לערוך אותה.");
			}
		}
	}
	else {
	$this->error_handler->show("עליך להתחבר למערכת.", "עליך להתחבר למערכת על מנת לערוך תגובות");
	}
	}
	
	}
}

?>



