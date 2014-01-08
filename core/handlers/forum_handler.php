<?PHP

// * With this class, you can create new PDO statements ALOT easier with MUCH less code
// * This file is a part of the A_M CORE
// * Author - Amir Mendelson
// * File Version : 1.2

class forum {

		 function orderThreads($threads) {
	global $db;
	if(is_array($threads)) {
 $forum_threads_order = array();
 $nu_threads = count($threads);
  for ($f=0; $f<=$nu_threads-1; $f++){
	  $thread_get_posts = $db ->Get(1,"posts", 'thread', $threads[$f], 'id'); 
	  $thread_get_posts_c = count($thread_get_posts);
	  
	  if ($thread_get_posts_c > 0) {
		  
		  $noposts = 1;
	    $thread_get_last_post_id = $thread_get_posts[$thread_get_posts_c-1];
		$thread_get_last_post_author_id = $db ->Get(1,"posts", 'id', $thread_get_last_post_id, 'user'); 
		$thread_get_last_post_author_name = $db ->Get(1,"members", 'id', $thread_get_last_post_author_id[0], 'username'); 
		$last_post_date = $db ->Get(1,"posts", 'id', $thread_get_last_post_id, 'publish_date'); }
		else {
		$last_post_date = $db ->Get(1,"threads", 'id', $threads[$f], 'publish_date');
		}
	  
	  $forum_threads_order[$f] = array($threads[$f],$last_post_date[0]);
  }
  



$this->array_sort_by_column($forum_threads_order, 1);
return $forum_threads_order;
		}
	else { return $threads; }
}

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


function getThreadIcon($thread) {
	global $db;
	$locked = $db ->Get(1,"threads", 'id', $thread, 'locked'); 
	$pinned = $db ->Get(1,"threads", 'id', $thread, 'pinned'); 
	if ($locked[0] == 1) { return 'lock'; }
	else if($pinned[0] == 1) { return 'pushpin'; }
	else {
	return 'folder-close';
	}
	
}

function getPermissions($forum_id, $return) {
	global $db;
	
	// Get user rank
	
	if (!isset($_SESSION['username'])) {
	 $rank = 0;
	 }
	 
	 else {
	$get_user_rank = $db ->Get(1,"members", 'id', $_SESSION['username'], 'rank'); 
	$rank = $get_user_rank[0];
	 }
	 
	$get_per_by_rank = $db ->Get(1,"permissions", 'rank_id', $rank, 'id');
	
	for ($i=0; $i<=count($get_per_by_rank)-1; $i++){
	$get_per_forum_id = $db ->Get(1,"permissions", 'id', $get_per_by_rank[$i], 'forum_id');	
	
	if ($get_per_forum_id[0] == $forum_id) {
		
	$per_rank = $db ->Get(1,"permissions", 'id', $get_per_by_rank[$i], 'rank_id'); 
	$per_view = $db ->Get(1,"permissions", 'id', $get_per_by_rank[$i], 'view'); 
	$per_post = $db ->Get(1,"permissions", 'id', $get_per_by_rank[$i], 'post'); 
	$per_post_threads = $db ->Get(1,"permissions", 'id', $get_per_by_rank[$i], 'post_threads'); 
		
	if ($return == "view") {
		// If view is OFF
	if ($per_view[0] == 1) {
		
		// If Users Rank == Permission Rank
		if ($per_rank[0] == $rank) {
		//$this->error_handler->show(404, "אתה לא רשאי לצפות בפורום הזה"); 
		return 1;
		}
		
		else {
		return 0;
		}
	}
	}
	
	else if ($return == "post") {
		
		// If Posting is OFF
	if ($per_post[0] == 1) {
		
		// If Users Rank == Permission Rank
		if ($per_rank[0] == $rank) {
		return 1;
		echo $per_rank[0];
		}
		
		else {
		return 0;
		}
	}
		
	}
	
	else if ($return == "post_thread") {
		
		// If Posting Threads is OFF
	if ($per_post_threads[0] == 1) {
		
		// If Users Rank == Permission Rank
		if ($per_rank[0] == $rank) {
		return 1;
		}
		
		else {
		return 0;
		}
	}
	
	}
	
	
	}
	
	}
	
	 

	 }






function ranktoText($rank) {
	global $db;
	$getrank = $db ->Get(1,"ranks", 'id', $rank, 'name');
	if (count($getrank) < 0) { return 'error';}
	else { return $getrank[0]; }
}

function rankColor($rank) {
	global $db;
	$getrank = $db ->Get(1,"ranks", 'id', $rank, 'color');
	if (empty($getrank)) { $getrank = "";} else { $getrank = $getrank[0];}
	if (count($getrank) < 0) { return 'black';}
	else { return $getrank; }
}

public function redirect($file){
	echo '<script type="text/javascript">
<!--
window.location = "'.$file.'"
//-->
</script>';
}

}

?>
