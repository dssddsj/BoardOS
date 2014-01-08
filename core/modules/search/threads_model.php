<?PHP

class model extends search {	
	
	public function __construct() {
		// Get engine construct vars
		parent::__construct();
		global $db, $threads, $details;
		// Get ID from URL
$user_id = $_GET['user'];

// Get thread name by ID
$username = $db ->Get(1,"members", 'id', $user_id, 'username'); 

// Count the results
$user_check = count($username );

// If Forum doesn't exist	
if ($user_check == 0) {
//ERROR404
$this->error_handler->show(404, "המשתמש לא נמצא."); 
}

// If User exists
else {	
$user_threads = $db ->Get(1,"threads", 'user', $user_id, 'id'); 
$nu_threads = count($user_threads);

// How many threads to show each page
$threads_per_page = 15;


// Amount of pages in forum
$pages = $nu_threads / $threads_per_page;
$pages = ceil($pages);

// Get the current page
if (isset($_GET['page'])) {
	$cu_page = $_GET['page'];
	if ($cu_page > $pages) {
		$this->error_handler->show(404, "העמוד אותו אתה מחפש לא נמצא."); 
	}
}	

else {
	$cu_page = 1;
}

$threads = array();

// Order threads by date
$start_f_value = $cu_page-1;
$start_f_value = $start_f_value*$threads_per_page;
$thread_order_P = $this->forum_handler->orderThreads($user_threads);
$thread_order_P = array_reverse($thread_order_P);

$thread_order = array_slice($thread_order_P, $start_f_value, $threads_per_page);

$nu_threads = count($thread_order);
$nu_threads = $nu_threads-1;
 
$details = array(); 
 
		
for ($i=0; $i<=$nu_threads; $i++){
		
		//$reverse_i = $nu_threads-$i;
		$thread_id = $thread_order[$i][0];	
		
		$thread_title = $db ->Get(1,"threads", 'id', $thread_id, 'title'); 
		$thread_date = $db ->Get(1,"threads", 'id', $thread_id, 'publish_date'); 
		$thread_views = $db ->Get(1,"threads", 'id', $thread_id, 'views'); 		
		$thread_get_posts = $db ->Get(1,"posts", 'thread', $thread_id, 'id'); 
		$thread_get_posts_c = count($thread_get_posts);
		
		if ($thread_get_posts_c > 0) {$noposts = 1; $thread_get_last_post_id = $thread_get_posts[$thread_get_posts_c-1];
		$thread_get_last_post_author_id = $db ->Get(1,"posts", 'id', $thread_get_last_post_id, 'user'); 
		$thread_get_last_post_author_name = $db ->Get(1,"members", 'id', $thread_get_last_post_author_id[0], 'username'); 
		$thread_get_last_post_date = $db ->Get(1,"posts", 'id', $thread_get_last_post_id, 'publish_date'); 
		$thread_get_last_post_date = $this->date_handler->datetostring($thread_get_last_post_date[0]);

		
		}
		
		else {
		$thread_get_last_post_author_id = NULL;
		$thread_get_last_post_author_name = NULL;
		$thread_get_last_post_date = NULL;		
		}
		
		$thread_date = $this->date_handler->datetostring($thread_date[0]);
		
		
		$threads[$i]['id'] = $thread_id;
		$threads[$i]['title'] = $thread_title[0];
		$threads[$i]['title'] = $this->html_purifier->purify($threads[$i]['title']);
		$threads[$i]['publish_date'] = $thread_date;
		$threads[$i]['author_id'] = $user_id;
		$threads[$i]['author_name'] = $username[0];
		$threads[$i]['views'] = $thread_views[0];
		$threads[$i]['number_of_posts'] = $thread_get_posts_c;
		$threads[$i]['last_post_author_id'] = $thread_get_last_post_author_id[0];
		$threads[$i]['last_post_author_name'] = $thread_get_last_post_author_name[0];
		$threads[$i]['last_post_date'] = $thread_get_last_post_date;
		
		
}

$details['user_id'] = $user_id;
$details['user_name'] = $username[0];
$details['threads_per_page'] = $threads_per_page;
$details['pages'] = $pages;
$details['cu_page'] = $cu_page;
}

	}
}

?>



