<?PHP
class model extends showThread {
		
function __construct() {
parent::__construct();
global $db, $thread, $posts;
		
	// Get thread ID from url
	$thread_id = $_GET['showThread'];
	
	// Get threads with that ID
	$thread_title = $db ->Get(1,"threads", 'id', $thread_id, 'title'); 
	
	// Count results
	$thread_check_id = count($thread_title);
	
	
	// If results == 0, the thread doesn't exist
	if ($thread_check_id == 0) {
	// Output Error 404
	$this->error_handler->show(404, "האשכול אותו אתה מחפש אינו קיים"); 
}
	
	// If thread exist
else {	

        $thread = array();

        // Get thread details
		$thread_forum = $db ->Get(1,"threads", 'id', $thread_id, 'forum'); 
		$thread_locked = $db ->Get(1,"threads", 'id', $thread_id, 'locked'); 
		$thread_content = $db ->Get(1,"threads", 'id', $thread_id, 'content'); 
		$thread_author_id = $db ->Get(1,"threads", 'id', $thread_id, 'user'); 
		$thread_views = $db ->Get(1,"threads", 'id', $thread_id, 'views'); 
		$thread_author_name = $db ->Get(1,"members", 'id', $thread_author_id[0], 'username'); 
		$post_author_rank = $db ->Get(1,"members", 'id', $thread_author_id[0], 'rank');
		$post_author_rank_color = $this->forum_handler->rankColor($post_author_rank[0]);
		$post_author_firstname = $db ->Get(1,"members", 'id', $thread_author_id[0], 'first_name');
		
		$get_author_posts = $db ->Get(1,"posts", 'user', $thread_author_id[0], 'id'); 
		$get_author_posts_amount = count($get_author_posts);
		$get_author_threads = $db ->Get(1,"threads", 'user', $thread_author_id[0], 'id'); 
		$get_author_threads_amount = count($get_author_threads);
		$get_author_posts_amount = $get_author_posts_amount + $get_author_threads_amount;
		$post_author_rank = $this->forum_handler->ranktoText($post_author_rank[0]);
		
		$thread_n_views = $thread_views[0]+1;
		$db -> Edit("threads", "views", $thread_n_views, $thread_id);
		
		$thread['forum'] = $thread_forum[0];
		$thread['locked'] = $thread_locked[0];
		$thread['id'] = $thread_id;
		$thread['title'] = $thread_title[0];
		$thread['title'] = $this->html_purifier->purify($thread['title']);
		$thread['content'] = $thread_content[0];
		$thread['content'] = $this->html_purifier->purify($thread['content']);
		$thread['author_id'] = $thread_author_id[0];
		$thread['author_name'] = $thread_author_name[0];
		$thread['author_name'] = $this->html_purifier->purify($thread['author_name']);
		$thread['author_rank'] = $post_author_rank;
		$thread['author_rank_color'] = $post_author_rank_color;
		$thread['author_firstname'] = $post_author_firstname[0];
		$thread['author_firstname'] = $this->html_purifier->purify($thread['author_firstname']);
		$thread['author_posts'] = $get_author_posts_amount;
		

			
		
		if(isset($_SESSION['username'])) { if($_SESSION['username'] == $thread_author_id[0]) { $mode = 1; }else{$mode = 2;} }
		else {$mode = 0;}
		
			
	
	$thread_posts = $db ->Get(1,"posts", 'thread', $thread_id, 'id'); 
	$count_thread_posts = count($thread_posts);
	
	for ($i=0; $i<=$count_thread_posts-1; $i++){
		$post_id = $thread_posts[$i];
		$post_content = $db ->Get(1,"posts", 'id', $post_id, 'content'); 
		
		$post_date = $db ->Get(1,"posts", 'id', $post_id, 'publish_date');
		$post_date = $this->date_handler->datetostring($post_date[0]);
		 
		$post_author_id = $db ->Get(1,"posts", 'id', $post_id, 'user'); 
		$post_author_name = $db ->Get(1,"members", 'id', $post_author_id[0], 'username');
		$post_author_rank = $db ->Get(1,"members", 'id', $post_author_id[0], 'rank');
		$post_author_rank_color = $this->forum_handler->rankColor($post_author_rank[0]);
		
		$post_author_firstname = $db ->Get(1,"members", 'id', $post_author_id[0], 'first_name');
		$get_author_posts = $db ->Get(1,"posts", 'user', $post_author_id[0], 'id'); 
		$get_author_posts_amount = count($get_author_posts);
		$get_author_threads = $db ->Get(1,"threads", 'user', $post_author_id[0], 'id'); 
		$get_author_threads_amount = count($get_author_threads);
		$get_author_posts_amount = $get_author_posts_amount + $get_author_threads_amount;
		$post_author_rank = $this->forum_handler->ranktoText($post_author_rank[0]);
		
		if(isset($_SESSION['username'])) { if($_SESSION['username'] == $post_author_id[0]) { $mode = 1; }else{$mode = 2;} }
		else {$mode = 0;}
		
		$current_post = $i +1;
		
		$posts[$i]['id'] = $post_id;
		$posts[$i]['content'] = $post_content[0];
		$posts[$i]['content'] = $this->html_purifier->purify($posts[$i]['content']);
		$posts[$i]['date'] = $post_date;
		$posts[$i]['author_id'] = $post_author_id[0];
		$posts[$i]['author_name'] = $post_author_name[0];
		$posts[$i]['author_name'] = $this->html_purifier->purify($posts[$i]['author_name']);
		$posts[$i]['author_rank'] = $post_author_rank;
		$posts[$i]['author_rank_color'] = $post_author_rank_color;
		$posts[$i]['author_firstname'] = $post_author_firstname[0];
		$posts[$i]['author_firstname'] = $this->html_purifier->purify($posts[$i]['author_firstname']);
		$posts[$i]['author_posts'] = $get_author_posts_amount;
		
		
		
		
  }

}



}

}




?>



