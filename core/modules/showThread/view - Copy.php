<?PHP

class view extends showThread {
function __construct() {
global $thread, $posts;

echo '<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">'.$thread['title'].'</h3>
  </div>
  <div class="panel-body thread">
  <table border="0" class="thread-posts col-lg-12">
<tr>	
<td class="post-author"><span class="author-name"><a style="color:'.$thread['author_rank_color'].'"href="?showProfile='.$thread['author_id'].'" class="author" data-toggle="tooltip" data-placement="top" title="לחץ בכדי לצפות בפרופיל">'.$thread['author_name'].'</a><br />'.$thread['author_rank'].'</span><span class="author-info">הודעות : '.$thread['author_posts'].' <br />שם : '.$thread['author_firstname'].'</span></td>
</tr>
<tr>
<td class="post-content">'.$thread['content'].'</td>

</tr>
<tr>
<td class="post-actions">';

if(isset($_SESSION['username'])) { if($_SESSION['username'] == $thread['author_id']) { $mode = 1; }else{$mode = 2;} }
		else {$mode = 0;}

if ($mode == 1) {
echo '<a href="?editThread='.$thread['id'].'" class="btn btn-default"><i class="icon-comment"></i> עריכה</a> ';
}

echo '<a href="#" class="btn btn-default"><i class="icon-comment"></i> ציטוט</a> <a href="#" class="btn btn-default"><i class="icon-warning-sign"></i> דיווח</a> <a href="#" class="btn btn-primary"><i class="icon-thumbs-up"></i></a></td>
</tr>
	
  </table></div>
</div>';

for ($i=0; $i<=count($posts)-1; $i++){
	$cu_post = $i+1;
echo '<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title post">תגובה #'.$cu_post.' | פורסם לפני '.$posts[$i]['date'].'</h3>
  </div>
  <div class="panel-body thread">';
		
		echo '<table border="0" class="thread-posts col-lg-12">
<tr>
<td class="post-author"><span class="author-name"><a style="color:'.$posts[$i]['author_rank_color'].'" href="?showProfile='.$posts[$i]['author_id'].'" class="author" data-toggle="tooltip" data-placement="top" title="לחץ בכדי לצפות בפרופיל">'.$posts[$i]['author_name'].'</a><br />'.$posts[$i]['author_rank'].'</span><span class="author-info">הודעות : '.$posts[$i]['author_posts'].' <br />שם : '.$posts[$i]['author_firstname'].'</span></td>
</tr>
<tr>
<td class="post-content">'.$posts[$i]['content'].'</td>
</tr>
<tr><td class="post-actions">';

if(isset($_SESSION['username'])) { if($_SESSION['username'] == $posts[$i]['author_id']) { $mode = 1; }else{$mode = 2;} }
else {$mode = 0;}

if ($mode == 1) {
echo '<a href="?editPost='.$posts[$i]['id'].'" class="btn btn-default"><i class="icon-comment"></i> עריכה</a> ';
}

echo'<a href="#" class="btn btn-default"><i class="icon-comment"></i> ציטוט</a> <a href="#" class="btn btn-default"><i class="icon-warning-sign"></i> דיווח</a> <a href="#" class="btn btn-primary"><i class="icon-thumbs-up"></i></a></td>
</tr>
</table></div>
</div>';
}


  echo '
 

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">הוסף תגובה</h3>
  </div>
  <div class="panel-body">';
  if (!isset($_SESSION['username'])) {echo 'על מנת להגיב, אתה צריך ל<a data-toggle="modal" href="#login">התחבר למערכת</a>';}
  else {
  echo '
   <form action="?add=post" method="POST">
<textarea name="content" class="ckeditor" rows="3" placeholder="כתוב תגובתך כאן"></textarea>
<input type="hidden" name="thread-id" value="'.$thread['id'].'">
<input type="submit" value="פרסם הודעה" class="btn btn-success" style="float:left; margin-top:10px;">
</form>
  


';
  
  }
  

}
}

?>



