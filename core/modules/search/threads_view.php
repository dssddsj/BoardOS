<?PHP

class view extends act {	
	
	public function __construct() {
		parent::__construct();
		global $threads, $details;
		
		echo '<div class="row"> 
  <div class="col-lg-12">

   <h1 class="forum-title">אשכולות שנפתחו על ידי '.$details['user_name'].'</h1>
   
  <table class="threads" border="0" cellpadding="3">
	<tbody><tr>
	    <th></th>
		<th>כותרת האשכול \ מפרסם האשכול</th>
		<th>סטטיסטיקה</th>		
		<th>הודעה אחרונה</th>
	</tr>
  ';
  
  
  
for ($i=0; $i<=count($threads)-1; $i++){
	$icon = $this->forum_handler->getThreadIcon($threads[$i]['id']);
	echo '<tr>';
	echo '<td class="icon"><i class="icon-'.$icon.'"></i></td>';
	echo '<td>
	<a href="?showThread='.$threads[$i]['id'].'">'.$threads[$i]['title'].'</a>
	<span class="author">נפתח ע"י <a href="?showProfile='.$threads[$i]['author_id'].'">'.$threads[$i]['author_name'].'</a> לפני '.$threads[$i]['publish_date'].'</span>
	</td>';
	echo '<td>תגובות : '.$threads[$i]['number_of_posts'].' <br />צפיות : '.$threads[$i]['views'].'</td>';
	if ($threads[$i]['last_post_date'] == NULL) { 
	echo '<td>אין תגובה אחרונה</td>';
	}
	
	else {
	echo '<td>לפני '.$threads[$i]['last_post_date'].' <br />על ידי : <a href="?showProfile='.$threads[$i]['last_post_author_id'].'">'.$threads[$i]['last_post_author_name'].'</a></td>';
	}
	
	echo '</tr>';
	
}
echo ' </tbody>
</table>';


echo '<ul class="pagination" style="float:right; -webkit-padding-start: 0px;
">';
if ($details['cu_page'] == 1) {
	echo '<li class="disabled"><a>&raquo;</a></li>';
}
else {
	$last_page = $details['cu_page'] -1;
	echo '<li><a href="?showForum='.$details['forum_id'].'&'.$last_page.'">&raquo;</a></li>';
}

for ($i=0; $i<=$details['pages']-1; $i++){
	$cu_id = $i+1;
	if ($details['cu_page'] == $cu_id) { $active = "active"; } else { $active="";};
	echo '<li class="'.$active.'"><a href="?search=threads&user='.$details['user_id'].'&page='.$cu_id.'">'.$cu_id.'</a></li>';
}

echo '
  <li><a href="#">&laquo;</a></li>
</ul>';

}

}

?>



