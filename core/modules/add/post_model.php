<?PHP
class model extends add {
	function __construct() {
		parent::__construct();
       global $db, $date;
	   
		if(isset($_POST['thread-id'])) {
			
			
			if (!strlen(strip_tags($_POST['content'])) >= 5) {
				$this->error_handler->show(8, "תוכן ההודעה חייב להכיל לפחות 5 תווים."); 
				}
				
				
				
else {	

                $_POST['content'] = $this->html_purifier->purify($_POST['content']);
				
				$post_pre =  $this->forum_handler->getPermissions($_POST['forum-id'], 'post');
			  if ($post_pre == 1) {$this->error_handler->show(404, "אינך רשאי לפרסם הודעות בפורום הזה.");}

				$user_posts = $db ->Get(1,"posts", 'user', $_SESSION['username'], 'id'); 
				
				// GET USER LAST POST
				$user_posts = end($user_posts);
 				
				// GET USER LAST POST DATE
				$last_post_date = $db ->Get(1,"posts", 'id', $user_posts, 'publish_date'); 
				
				// TIME PASSED SINCE LAST POST
				$timepassed = $this->date_handler->timepassed($last_post_date[0]);
				
				// TIME BETWEEN POSTING NEW POSTS
				$wait_time = 15;

if ($timepassed >= $wait_time ) {		
$columns = array('content','user','thread','publish_date','edit_date');
$values = array($_POST['content'], $_SESSION['username'], $_POST['thread-id'], $date, '');
$db -> Add("posts", $columns, $values);
$last_id = $db->getID();
if (!empty($last_id)) {$this->forum_handler->redirect('?showThread='.$_POST['thread-id'].'');}
}
else {
	$this->error_handler->show(8, 'עליך להמתין לפחות '.$wait_time.' שניות בין פרסום של הודעות.'); 
}
}
	
}

else {
	$this->forum_handler->redirect('index.php');
}
	}
}

?>



