<?PHP
class model extends add {
	function __construct() {
		parent::__construct();
       global $db;
	   
		
		
		if(isset($_POST['forum-id'])) {
			
			global $date;
			
			// IF USER IS POSTING TO OPEN A NEW THREAD
			
            $post_threads_pre =  $this->forum_handler->getPermissions($_POST['forum-id'], 'post_thread');
			if ($post_threads_pre == 1) {$this->error_handler->show(404, "אינך רשאי לפרסם אשכולות בפורום הזה.");}
		
			$_POST['content'] = $this->html_purifier->purify($_POST['content']);
			$_POST['title'] = $this->html_purifier->purify($_POST['title']);
			
			if (!strlen(strip_tags($_POST['content'])) >= 5) {
				$this->error_handler->show(8, "תוכן האשכול חייב להכיל לפחות 5 תווים"); 
				}
				
				if (!strlen($_POST['title']) >= 5) {
				$this->error_handler->show(8, "כותרת האשכול חייבת להכיל לפחות 5 תווים"); 
				}
				
				$user_threads = $db ->Get(1,"threads", 'user', $_SESSION['username'], 'id'); 
				
				// Get USER LATEST THREAD	
                $user_threads = end($user_threads);
				
				// Get USER LATEST THREAD DATE
                $last_thread_date = $db ->Get(1,"threads", 'id', $user_threads, 'publish_date');
				 
				// TIME PASSED SINCE LAST THREAD CREATED
                $timepassed = $this->date_handler->timepassed($last_thread_date[0]);

                // TIME BETWEEN CREATING THREADS
                $wait_time = 45;

if ($timepassed >= $wait_time ) {
$_POST['title'] = strip_tags($_POST['title']);
$columns = array('title','content','user','forum','publish_date');
$values = array($_POST['title'], $_POST['content'], $_SESSION['username'], $_POST['forum-id'], $date);
$db -> Add("threads", $columns, $values);
$last_id = $db->getID();
if (!empty($last_id)) {$this->forum_handler->redirect('?showThread='.$last_id.'');}
}
else {
	$this->error_handler->show(8, 'עליך להמתין לפחות '.$wait_time.' שניות בין פרסום של אשכולות.'); 
}
				
			}	
			
			else {
				
				if(!isset($_GET['forum'])) {
			// FORUM ID NOT SET, ERROR
			$this->error_handler->show(404, "עליך להגדיר פורום אליו אתה רוצה לפרסם.");
		}
		
		else {
			$forum_name = $db ->Get(1,"forums", 'id', $_GET['forum'], 'name'); 
		if (count($forum_name) == 0) {
			// FORUM DOESN'T EXIST, ERROR
			$this->error_handler->show(404, "הפורום בוא אתה מנסה לפרסם אשכול לא קיים.");
			}
		}
				
			}
			
		}
	
}


?>



