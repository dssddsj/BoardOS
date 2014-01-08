<?PHP
class model extends showForum {
		
function __construct() {
parent::__construct();
global $db, $details, $threads;

// Get ID from URL
$forum_id = $_GET['showForum'];

// Get thread name by ID
$forum_name = $db ->Get(1,"forums", 'id', $forum_id, 'name'); 

// Count the results
$forum_check_id = count($forum_name);

// If Forum doesn't exist	
if ($forum_check_id == 0) {
//ERROR404
$this->error_handler->show(404, "הפורום אותו אתה מחפש לא קיים"); 
}

// If Forum exists	
else {
	
$view_pre =  $this->forum_handler->getPermissions($forum_id, 'view');
//$post_pre =  $this->forum_handler->getPermissions($forum_id, 'post');
//$post_threads_pre =  $this->forum_handler->getPermissions($forum_id, 'post_thread');
//echo $view_pre." <br /> פוסטים : ".$post_pre." <br /> אשכולות : ".$post_threads_pre;

if ($view_pre == 1) {$this->error_handler->show(404, "אתה לא רשאי לצפות בפורום הזה"); }
	
$forum_threads = $db ->Get(1,"threads", 'forum', $forum_id, 'id'); 
$nu_threads = count($forum_threads);

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
$thread_order_P = $this->forum_handler->orderThreads($forum_threads);
$thread_order_P = array_reverse($thread_order_P);

$thread_order = array_slice($thread_order_P, $start_f_value, $threads_per_page);

$nu_threads = count($thread_order);
$nu_threads = $nu_threads-1;
 
$details = array(); 
 
		
for ($i=0; $i<=$nu_threads; $i++){
		
		//$reverse_i = $nu_threads-$i;
		$thread_id = $thread_order[$i][0];	
		
		$thread_title = $db ->Get(1,"threads", 'id', $thread_id, 'title'); 
		$thread_pinned = $db ->Get(1,"threads", 'id', $thread_id, 'pinned'); 
		if ($thread_pinned[0] == 1) { $details['pinned'] = 1; } 
		$thread_date = $db ->Get(1,"threads", 'id', $thread_id, 'publish_date'); 
		$thread_views = $db ->Get(1,"threads", 'id', $thread_id, 'views'); 
		$thread_author_id = $db ->Get(1,"threads", 'id', $thread_id, 'user'); 
		$thread_author_name = $db ->Get(1,"members", 'id', $thread_author_id[0], 'username'); 
		
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
		$threads[$i]['views'] = $thread_views[0];
		$threads[$i]['author_id'] = $thread_author_id[0];
		$threads[$i]['author_name'] = $thread_author_name[0];
		$threads[$i]['number_of_posts'] = $thread_get_posts_c;
		$threads[$i]['last_post_author_id'] = $thread_get_last_post_author_id[0];
		$threads[$i]['last_post_author_name'] = $thread_get_last_post_author_name[0];
		$threads[$i]['last_post_date'] = $thread_get_last_post_date;
		$threads[$i]['pinned'] = $thread_pinned[0];
		
		
}

$details['forum_name'] = $forum_name[0];
$details['forum_id'] = $forum_id;
$details['threads_per_page'] = $threads_per_page;
$details['pages'] = $pages;
$details['cu_page'] = $cu_page;
}
}
}

?>



