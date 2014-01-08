<?PHP
class model extends showIndex {
		
function __construct() {
parent::__construct();
global $db, $categories, $forums;
$get_categories = $db ->Get(2,"categories", '', '', 'id'); 
$nu_categories = count($get_categories);

$categories = array();
$forums = array();
	
	for ($i=0; $i<=$nu_categories-1; $i++){
	$category_id = $get_categories[$i];
	$categories[$i]['id'] = $category_id; 
	$categories[$i]['name'] = $db ->Get(1,"categories", 'id', $category_id, 'name'); 
	$categories[$i]['name'] = $categories[$i]['name'][0];
	$get_forums = $db ->Get(1,"forums", 'category', $category_id, 'id'); 
	$nu_forums = count($get_forums);
	
    if ($nu_forums == 0 ) {
		 // No forums in this category
		}
	
	for ($f=0; $f<=$nu_forums-1; $f++){
		
		$forum_id = $get_forums[$f];
		$forum_name = $db ->Get(1,"forums", 'id', $forum_id, 'name'); 
		$forum_desc = $db ->Get(1,"forums", 'id', $forum_id, 'description'); 
		$forum_icon = $db ->Get(1,"forums", 'id', $forum_id, 'icon'); 
		
		$forum_threads = $db ->Get(1,"threads", 'forum', $forum_id, 'id'); 
		$forum_threads_count = count($forum_threads);
		
		$forum_posts_all = 0;
		
		for ($p=0; $p<=$forum_threads_count-1; $p++){
		$forum_posts = $db ->Get(1,"posts", 'thread', $forum_threads[$p], 'id'); 
		$forum_posts_count = count($forum_posts);
		$forum_posts_all = $forum_posts_count + $forum_posts_all;
		}
		
		$forums[$i][$f]['id'] = $forum_id;
		$forums[$i][$f]['name'] = $forum_name[0];
		$forums[$i][$f]['desc'] = $forum_desc[0];
		$forums[$i][$f]['icon'] = $forum_icon[0];
		$forums[$i][$f]['threads_count'] = $forum_threads_count;
		$forums[$i][$f]['posts_count'] = $forum_posts_all;
		
			
	}
	
	}
}



}

?>



