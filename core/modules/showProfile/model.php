<?PHP
class model extends showProfile {
		
function __construct() {
parent::__construct();
global $db, $profile;

$profile = array();

$user_id = $_GET['showProfile'];
$user_name = $db ->Get(1,"members", 'id', $user_id, 'username');

if (count($user_name) > 0) {
$user_rank = $db ->Get(1,"members", 'id', $user_id, 'rank');
$user_rank = $this->forum_handler->ranktoText($user_rank[0]);
$user_firstname = $db ->Get(1,"members", 'id', $user_id, 'first_name');
$user_posts = $db ->Get(1,"posts", 'user', $user_id, 'id');
$user_posts = count($user_posts);

$thread_posts = $db ->Get(1,"threads", 'user', $user_id, 'id');
$thread_posts = count($thread_posts);

$join_date = $db ->Get(1,"members", 'id', $user_id, 'join_date');
$join_date = $this->date_handler->datetostring($join_date[0]);
	
	
	$profile['id'] = $user_id;
	$profile['name'] = $user_name[0];
	$profile['name'] = $this->html_purifier->purify($profile['name']);
	$profile['rank'] = $user_rank;
	$profile['firstname'] = $user_firstname[0];
	$profile['firstname'] = $this->html_purifier->purify($profile['firstname']);
	$profile['posts'] = $user_posts;
	$profile['threads'] = $thread_posts;
	$profile['join_date'] = $join_date;

	
	}
	
	// If user doesn't exist
else {
	// ERROR 404
	 }
}

}

?>



