<?PHP

class model extends search {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
		global $db, $thread;
		
		if (isset($_GET['id'])) {
		
		// Get ID from URL
				
		if (isset($_SESSION['username'])) {
		$thread_id = $_GET['id'];
		$thread_content = $db ->Get(1,"threads", 'id', $thread_id, 'content'); 
		$thread_title = $db ->Get(1,"threads", 'id', $thread_id, 'title'); 
		$thread_author_id = $db ->Get(1,"threads", 'id', $thread_id, 'user');
		
		if (count($thread_content) == 0){ 
		// Thread doesn't exist
		$this->error_handler->show("האשכול לא קיים", "לא ניתן לערוך את האשכול הנוכחי.");
		}
		 
		else {
			if ($_SESSION['username'] == $thread_author_id[0]) {
				// If user own current thread
				$thread['id'] = $thread_id;
				$thread['title'] = $thread_title[0];
				$thread['content'] = $thread_content[0];
	}
	else {
	 $this->error_handler->show('האשכול שאתה מנסה לערוך אינה שלך.', 'האשכול שאתה מנסה לערוך אינו שלך ולכן אינך יכול לערוך אותו.');
	}
	
	}
	
	}
	else {
	$this->error_handler->show('עליך להתחבר למערכת.', 'עליך להתחבר למערכת על מנת לערוך אשכולות');
	}
	}
	
	else {
		// ID not specified
	}
	
	if (isset($_POST['thread-id'])) {
		if (isset($_SESSION['username'])) {
		$thread_id = $_POST['thread-id'];
		$thread_content = $db ->Get(1,"threads", 'id', $thread_id, 'content'); 
		$thread_author_id = $db ->Get(1,"threads", 'id', $thread_id, 'user');
		if (count($thread_content) == 0){ 
	$this->error_handler->show("האשכול לא קיים", "לא ניתן לערוך את האשכול הנוכחי.");
	}
		else {
			if ($_SESSION['username'] == $thread_author_id[0]) {
				$thread_content = $_POST['content'];
				$thread_title = $_POST['title'];
				$db -> Edit("threads", "title" ,$thread_title, $thread_id);
				$db -> Edit("threads", "content" ,$thread_content, $thread_id);
				$this->forum_handler->redirect('?showThread='.$thread_id);
			}
			else {
  $this->error_handler->show('האשכול שאתה מנסה לערוך אינו שלך.', 'האשכול שאתה מנסה לערוך אינו שלך ולכן אינך יכול לערוך אותו.');
			}
		}
	}
	else {
	$this->error_handler->show('עליך להתחבר למערכת.', 'עליך להתחבר למערכת על מנת לערוך אשכולות');
	}
	}
	
	}
}

?>



